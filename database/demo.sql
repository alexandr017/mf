-- ==========================
-- Schema + Test Data (MySQL)
-- Выполни в MySQL / MariaDB
-- ==========================

SET @now = NOW();

-- --------------------------
-- 1) Таблица команд (IDs 1..20)
-- --------------------------
DROP TABLE IF EXISTS teams;
CREATE TABLE teams (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       name VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

INSERT INTO teams (id, name) VALUES
                                 (1,'Team 1'),(2,'Team 2'),(3,'Team 3'),(4,'Team 4'),
                                 (5,'Team 5'),(6,'Team 6'),(7,'Team 7'),(8,'Team 8'),
                                 (9,'Team 9'),(10,'Team 10'),(11,'Team 11'),(12,'Team 12'),
                                 (13,'Team 13'),(14,'Team 14'),(15,'Team 15'),(16,'Team 16'),
                                 (17,'Team 17'),(18,'Team 18'),(19,'Team 19'),(20,'Team 20');

-- --------------------------
-- 2) Основные таблицы турниров
-- --------------------------
DROP TABLE IF EXISTS tournaments;
CREATE TABLE tournaments (
                             id INT AUTO_INCREMENT PRIMARY KEY,
                             name VARCHAR(200),
                             country_id INT,
                             title VARCHAR(255),
                             alias VARCHAR(255),
                             meta_description TEXT,
                             image VARCHAR(255),
                             type ENUM('league','cup','supercup','mixed') NOT NULL,
                             content TEXT,
                             status TINYINT DEFAULT 1
) ENGINE=InnoDB;

DROP TABLE IF EXISTS tournaments_seasons;
CREATE TABLE tournaments_seasons (
                                     id INT AUTO_INCREMENT PRIMARY KEY,
                                     tournament_id INT NOT NULL,
                                     year_start INT NOT NULL,
                                     year_finish INT NOT NULL,
                                     status TINYINT DEFAULT 1,
                                     rules_json JSON NULL,
                                     FOREIGN KEY (tournament_id) REFERENCES tournaments(id) ON DELETE CASCADE
) ENGINE=InnoDB;

DROP TABLE IF EXISTS tournaments_stages;
CREATE TABLE tournaments_stages (
                                    id INT AUTO_INCREMENT PRIMARY KEY,
                                    tournaments_season_id INT NOT NULL,
                                    name VARCHAR(200) NOT NULL,
                                    type ENUM('league_round','cup_round','group_stage','playoff','final') NOT NULL,
                                    stage_order INT NOT NULL DEFAULT 1,
                                    FOREIGN KEY (tournaments_season_id) REFERENCES tournaments_seasons(id) ON DELETE CASCADE
) ENGINE=InnoDB;

DROP TABLE IF EXISTS tournaments_groups;
CREATE TABLE tournaments_groups (
                                    id INT AUTO_INCREMENT PRIMARY KEY,
                                    stage_id INT NOT NULL,
                                    name VARCHAR(50),
                                    FOREIGN KEY (stage_id) REFERENCES tournaments_stages(id) ON DELETE CASCADE
) ENGINE=InnoDB;

DROP TABLE IF EXISTS tournaments_matches;
CREATE TABLE tournaments_matches (
                                     id INT AUTO_INCREMENT PRIMARY KEY,
                                     stage_id INT NOT NULL,
                                     group_id INT NULL,
                                     team_1 INT NOT NULL,
                                     team_2 INT NOT NULL,
                                     `date` DATETIME NULL,
                                     score_1 TINYINT NULL,
                                     score_2 TINYINT NULL,
                                     pen_1 TINYINT NULL,
                                     pen_2 TINYINT NULL,
                                     status ENUM('scheduled','played','cancelled') DEFAULT 'scheduled',
                                     FOREIGN KEY (stage_id) REFERENCES tournaments_stages(id) ON DELETE CASCADE,
                                     FOREIGN KEY (group_id) REFERENCES tournaments_groups(id) ON DELETE SET NULL,
                                     FOREIGN KEY (team_1) REFERENCES teams(id) ON DELETE RESTRICT,
                                     FOREIGN KEY (team_2) REFERENCES teams(id) ON DELETE RESTRICT
) ENGINE=InnoDB;

-- --------------------------
-- 3) Вставляем 4 турнира
-- --------------------------
INSERT INTO tournaments (id, name, country_id, title, alias, type)
VALUES
    (1,'Национальный Чемпионат',1,'Чемпионат','national-championship','league'),
    (2,'Национальный Кубок',1,'Кубок','national-cup','cup'),
    (3,'Суперкубок',1,'Суперкубок','supercup','supercup'),
    (4,'Лига Чемпионов',0,'Лига Чемпионов','champions-league','mixed');

-- --------------------------
-- 4) Сезоны (по 2 сезона: 2022/23 и 2023/24)
-- --------------------------
INSERT INTO tournaments_seasons (id,tournament_id,year_start,year_finish,rules_json) VALUES
-- Чемпионат
(1,1,2022,2023, JSON_OBJECT('teams',20,'rounds',2)),
(2,1,2023,2024, JSON_OBJECT('teams',20,'rounds',2)),
-- Кубок
(3,2,2022,2023, JSON_OBJECT('teams',16,'single_leg',true)),
(4,2,2023,2024, JSON_OBJECT('teams',16,'single_leg',true)),
-- Суперкубок
(5,3,2022,2022, JSON_OBJECT('single_match',true)),
(6,3,2023,2023, JSON_OBJECT('single_match',true)),
-- Лига Чемпионов
(7,4,2022,2023, JSON_OBJECT('groups',4,'group_size',4,'group_rounds',2)),
(8,4,2023,2024, JSON_OBJECT('groups',4,'group_size',4,'group_rounds',2));

-- --------------------------
-- 5) Создаём стадии для каждого сезона
-- --------------------------
-- Для чемпионата: 2 этапа (условно Round 1 / Round 2)
INSERT INTO tournaments_stages (tournaments_season_id, name, type, stage_order) VALUES
                                                                                    (1,'Чемпионат — Круг 1','league_round',1),
                                                                                    (1,'Чемпионат — Круг 2','league_round',2),
                                                                                    (2,'Чемпионат — Круг 1','league_round',1),
                                                                                    (2,'Чемпионат — Круг 2','league_round',2);

-- Кубок: 1/8, 1/4, 1/2, Финал (для каждого сезона)
INSERT INTO tournaments_stages (tournaments_season_id, name, type, stage_order) VALUES
                                                                                    (3,'Кубок — 1/8','cup_round',1),
                                                                                    (3,'Кубок — 1/4','cup_round',2),
                                                                                    (3,'Кубок — 1/2','cup_round',3),
                                                                                    (3,'Кубок — Финал','final',4),
                                                                                    (4,'Кубок — 1/8','cup_round',1),
                                                                                    (4,'Кубок — 1/4','cup_round',2),
                                                                                    (4,'Кубок — 1/2','cup_round',3),
                                                                                    (4,'Кубок — Финал','final',4);

-- Суперкубок: финал один матч
INSERT INTO tournaments_stages (tournaments_season_id, name, type, stage_order) VALUES
                                                                                    (5,'Суперкубок — Финал','final',1),
                                                                                    (6,'Суперкубок — Финал','final',1);

-- Лига чемпионов: группы A..D и плейофф (QF/SF/Final)
-- для сезона 7
INSERT INTO tournaments_stages (tournaments_season_id, name, type, stage_order) VALUES
                                                                                    (7,'ЛЧ — Групповая стадия','group_stage',1),
                                                                                    (7,'ЛЧ — 1/4 финала','playoff',2),
                                                                                    (7,'ЛЧ — 1/2 финала','playoff',3),
                                                                                    (7,'ЛЧ — Финал','final',4),
-- для сезона 8
                                                                                    (8,'ЛЧ — Групповая стадия','group_stage',1),
                                                                                    (8,'ЛЧ — 1/4 финала','playoff',2),
                                                                                    (8,'ЛЧ — 1/2 финала','playoff',3),
                                                                                    (8,'ЛЧ — Финал','final',4);

-- Insert группы для стадий групповой ЛЧ (для обеих сезонных стадий)
-- Найдём id стадии групповой для сезонов 7 и 8:
-- (вставки ниже предполагают автогенерацию id в порядке вставки — для безопасности ищи реальный id в БД перед повторным запуском)
-- Но для простоты выполним SELECT чтобы узнать id — однако в скрипте ниже мы сделаем вставки динамически через подзапрос:

INSERT INTO tournaments_groups (stage_id, name)
SELECT s.id, ggrp.name FROM (
                                SELECT id, tournaments_season_id FROM tournaments_stages WHERE tournaments_season_id IN (7,8) AND type='group_stage'
                            ) s
                                CROSS JOIN (SELECT 'Group A' AS name UNION SELECT 'Group B' UNION SELECT 'Group C' UNION SELECT 'Group D') ggrp;

-- --------------------------
-- 6) Хранимые процедуры для генерации матчей (MySQL)
-- --------------------------
-- Мы используем DELIMITER для процедур
DELIMITER $$

-- Helper: простая функция случайного забитого мяча (0..4)
CREATE FUNCTION rand_goal() RETURNS INT DETERMINISTIC
    RETURN FLOOR(RAND()*5);

-- Процедура: generate_league_fixtures
-- Генерирует полный двухкруговой календарь для команды с IDs от 1..teams_count
-- Использует алгоритм круговой (circle method)
DROP PROCEDURE IF EXISTS generate_league_fixtures$$
CREATE PROCEDURE generate_league_fixtures(IN p_season_id INT, IN p_start_date DATE)
BEGIN
  DECLARE teams_count INT;
  DECLARE rounds INT;
  DECLARE i INT;
  DECLARE j INT;
  DECLARE match_date DATETIME;
  DECLARE stage1 INT;
  DECLARE stage2 INT;

SELECT JSON_EXTRACT(rules_json,'$.teams') INTO teams_count FROM tournaments_seasons WHERE id = p_season_id;
SELECT id INTO stage1 FROM tournaments_stages WHERE tournaments_season_id=p_season_id AND stage_order=1 AND type='league_round' LIMIT 1;
SELECT id INTO stage2 FROM tournaments_stages WHERE tournaments_season_id=p_season_id AND stage_order=2 AND type='league_round' LIMIT 1;

IF teams_count IS NULL THEN SET teams_count = 20; END IF;
  SET rounds = 1; -- we'll build first round, then mirror for second

  -- prepare array of team ids 1..teams_count (we assume teams are 1..teams_count)
  -- We'll use a temporary table to hold rotation
  DROP TEMPORARY TABLE IF EXISTS tmp_teams;
  CREATE TEMPORARY TABLE tmp_teams(idx INT AUTO_INCREMENT PRIMARY KEY, team_id INT);
  -- fill
  SET i = 1;
  WHILE i <= teams_count DO
    INSERT INTO tmp_teams(team_id) VALUES (i);
    SET i = i + 1;
END WHILE;

  -- if odd number of teams, add bye (not needed here)
  -- Number of rounds in single round-robin = teams_count - 1
  SET i = 1;
  WHILE i <= teams_count - 1 DO
    -- for each round, pair teams: (1 vs last), (2 vs last-1), ...
    SET j = 1;
    SET match_date = DATE_ADD(p_start_date, INTERVAL (i-1) DAY);
    -- get pairs
    -- we'll use joins on tmp_teams with variable offsets
    -- build pairs using SELECT with ORDER BY idx
    DROP TEMPORARY TABLE IF EXISTS order_teams;
    CREATE TEMPORARY TABLE order_teams AS SELECT @r:=@r+1 AS r, t.team_id FROM (SELECT @r:=0) r, tmp_teams t ORDER BY t.idx;
-- pairing: k from 1..teams_count/2
DECLARE k INT DEFAULT 1;
    DECLARE half INT;
    SET half = FLOOR(teams_count/2);
    WHILE k <= half DO
      -- team a = r = k, team b = r = teams_count - k + 1
      INSERT INTO tournaments_matches(stage_id, group_id, team_1, team_2, `date`, score_1, score_2, status)
SELECT stage1, NULL, a.team_id, b.team_id, match_date,
       rand_goal(), rand_goal(), 'played'
FROM (SELECT team_id FROM order_teams WHERE r = k) a,
     (SELECT team_id FROM order_teams WHERE r = (teams_count - k + 1)) b;
SET k = k + 1;
END WHILE;

    -- rotate array for next round: keep first fixed, move last to position 2
    -- implement rotation
    -- save first
SELECT team_id INTO @first_team FROM tmp_teams WHERE idx=1;
-- get last
SELECT team_id INTO @last_team FROM tmp_teams ORDER BY idx DESC LIMIT 1;
-- delete last
DELETE FROM tmp_teams ORDER BY idx DESC LIMIT 1;
-- shift: move remaining top->bottom via temporary table
DROP TEMPORARY TABLE IF EXISTS shifted;
    CREATE TEMPORARY TABLE shifted(team_id INT);
INSERT INTO shifted(team_id) SELECT team_id FROM tmp_teams WHERE idx>1 ORDER BY idx;
-- rebuild tmp_teams: first, then last, then shifted...
DELETE FROM tmp_teams;
INSERT INTO tmp_teams(team_id) VALUES (@first_team);
INSERT INTO tmp_teams(team_id) VALUES (@last_team);
INSERT INTO tmp_teams(team_id) SELECT team_id FROM shifted;
DROP TEMPORARY TABLE IF EXISTS shifted;
    DROP TEMPORARY TABLE IF EXISTS order_teams;
    SET i = i + 1;
END WHILE;

  -- now mirror for second leg (home/away swapped) using stage2, dates after first block
  -- We'll take existing matches for stage1 and create swapped matches for stage2 with shifted dates
  -- find max date from inserted stage1 matches and start second leg after +1 day
  DECLARE maxd DATETIME;
SELECT MAX(`date`) INTO maxd FROM tournaments_matches WHERE stage_id = stage1;
IF maxd IS NULL THEN SET maxd = p_start_date; END IF;

  -- For each match in stage1, insert a swapped match into stage2 with date = maxd + (row_index) days
  DROP TEMPORARY TABLE IF EXISTS tmp_stage1;
  CREATE TEMPORARY TABLE tmp_stage1 AS SELECT id, team_1, team_2, `date` FROM tournaments_matches WHERE stage_id = stage1 ORDER BY id;
SET i = 1;
  DECLARE cnt INT;
SELECT COUNT(*) INTO cnt FROM tmp_stage1;
WHILE i <= cnt DO
SELECT team_1, team_2 INTO @t1, @t2 FROM tmp_stage1 ORDER BY id LIMIT 1 OFFSET (i-1);
INSERT INTO tournaments_matches(stage_id, group_id, team_1, team_2, `date`, score_1, score_2, status)
VALUES(stage2, NULL, @t2, @t1, DATE_ADD(maxd, INTERVAL i DAY), rand_goal(), rand_goal(), 'played');
SET i = i + 1;
END WHILE;

  DROP TEMPORARY TABLE IF EXISTS tmp_stage1;
  DROP TEMPORARY TABLE IF EXISTS tmp_teams;
END$$

-- Процедура: generate_cup_bracket (топ-16 single leg)
DROP PROCEDURE IF EXISTS generate_cup_bracket$$
CREATE PROCEDURE generate_cup_bracket(IN p_season_id INT, IN p_start_date DATE)
BEGIN
  DECLARE stage1 INT; -- 1/8
  DECLARE stage2 INT; -- QF
  DECLARE stage3 INT; -- SF
  DECLARE stage4 INT; -- Final
SELECT id INTO stage1 FROM tournaments_stages WHERE tournaments_season_id=p_season_id AND name LIKE '%1/8%' LIMIT 1;
SELECT id INTO stage2 FROM tournaments_stages WHERE tournaments_season_id=p_season_id AND name LIKE '%1/4%' LIMIT 1;
SELECT id INTO stage3 FROM tournaments_stages WHERE tournaments_season_id=p_season_id AND name LIKE '%1/2%' LIMIT 1;
SELECT id INTO stage4 FROM tournaments_stages WHERE tournaments_season_id=p_season_id AND type='final' LIMIT 1;

-- Use teams 1..16 as participants (for test)
DROP TEMPORARY TABLE IF EXISTS cup_teams;
  CREATE TEMPORARY TABLE cup_teams (pos INT AUTO_INCREMENT PRIMARY KEY, team_id INT);
INSERT INTO cup_teams(team_id) SELECT id FROM teams WHERE id BETWEEN 1 AND 16;

-- Round of 16: pair sequentially (1v16,2v15,...) or shuffle
-- We'll pair pos k with pos (17-k)
DECLARE k INT DEFAULT 1;
  DECLARE half INT DEFAULT 8;
  DECLARE d DATETIME;
  SET d = p_start_date;
  WHILE k <= half DO
    INSERT INTO tournaments_matches(stage_id, group_id, team_1, team_2, `date`, score_1, score_2, status)
SELECT stage1, NULL,
       (SELECT team_id FROM cup_teams WHERE pos = k),
       (SELECT team_id FROM cup_teams WHERE pos = (17 - k)),
       DATE_ADD(d, INTERVAL (k-1) DAY),
       rand_goal(), rand_goal(), 'played';
SET k = k + 1;
END WHILE;

  -- For QF: take winners from Round of 16 in order and pair (1v2,3v4...)
  -- Create temporary table winners16 storing winner team ids:
  DROP TEMPORARY TABLE IF EXISTS winners16;
  CREATE TEMPORARY TABLE winners16 (pos INT AUTO_INCREMENT PRIMARY KEY, team_id INT);
INSERT INTO winners16(team_id)
SELECT CASE WHEN m.score_1 >= m.score_2 THEN m.team_1 ELSE m.team_2 END
FROM tournaments_matches m WHERE m.stage_id = stage1 ORDER BY m.id;

-- QF pairs
SET k = 1;
  SET d = DATE_ADD(p_start_date, INTERVAL 10 DAY);
  WHILE k <= 4 DO
    INSERT INTO tournaments_matches(stage_id, group_id, team_1, team_2, `date`, score_1, score_2, status)
SELECT stage2, NULL,
       (SELECT team_id FROM winners16 WHERE pos = (2*k -1)),
       (SELECT team_id FROM winners16 WHERE pos = (2*k)),
       DATE_ADD(d, INTERVAL (k-1) DAY),
       rand_goal(), rand_goal(), 'played';
SET k = k + 1;
END WHILE;

  -- SF
  DROP TEMPORARY TABLE IF EXISTS winners8;
  CREATE TEMPORARY TABLE winners8 (pos INT AUTO_INCREMENT PRIMARY KEY, team_id INT);
INSERT INTO winners8(team_id)
SELECT CASE WHEN m.score_1 >= m.score_2 THEN m.team_1 ELSE m.team_2 END
FROM tournaments_matches m WHERE m.stage_id = stage2 ORDER BY m.id;

SET k = 1;
  SET d = DATE_ADD(p_start_date, INTERVAL 20 DAY);
  WHILE k <= 2 DO
    INSERT INTO tournaments_matches(stage_id, group_id, team_1, team_2, `date`, score_1, score_2, status)
SELECT stage3, NULL,
       (SELECT team_id FROM winners8 WHERE pos = (2*k -1)),
       (SELECT team_id FROM winners8 WHERE pos = (2*k)),
       DATE_ADD(d, INTERVAL (k-1) DAY),
       rand_goal(), rand_goal(), 'played';
SET k = k + 1;
END WHILE;

  -- Final
  DROP TEMPORARY TABLE IF EXISTS winners4;
  CREATE TEMPORARY TABLE winners4 (pos INT AUTO_INCREMENT PRIMARY KEY, team_id INT);
INSERT INTO winners4(team_id)
SELECT CASE WHEN m.score_1 >= m.score_2 THEN m.team_1 ELSE m.team_2 END
FROM tournaments_matches m WHERE m.stage_id = stage3 ORDER BY m.id;

INSERT INTO tournaments_matches(stage_id, group_id, team_1, team_2, `date`, score_1, score_2, status)
SELECT stage4, NULL,
       (SELECT team_id FROM winners4 WHERE pos = 1),
       (SELECT team_id FROM winners4 WHERE pos = 2),
       DATE_ADD(p_start_date, INTERVAL 30 DAY),
       rand_goal(), rand_goal(), 'played';

DROP TEMPORARY TABLE IF EXISTS cup_teams;
  DROP TEMPORARY TABLE IF EXISTS winners16;
  DROP TEMPORARY TABLE IF EXISTS winners8;
  DROP TEMPORARY TABLE IF EXISTS winners4;
END$$

-- Процедура: generate_supercup_match
DROP PROCEDURE IF EXISTS generate_supercup_match$$
CREATE PROCEDURE generate_supercup_match(IN p_season_id INT, IN p_home INT, IN p_away INT, IN p_date DATETIME)
BEGIN
  DECLARE stage_final INT;
SELECT id INTO stage_final FROM tournaments_stages WHERE tournaments_season_id=p_season_id AND type='final' LIMIT 1;
INSERT INTO tournaments_matches(stage_id, group_id, team_1, team_2, `date`, score_1, score_2, status)
VALUES(stage_final, NULL, p_home, p_away, p_date, rand_goal(), rand_goal(), 'played');
END$$

-- Процедура: generate_champions_fixtures
-- Разбивает 16 команд в 4 группы по 4 (по порядку) и генерит двухкруговую групповую стадию, затем простую схему 1/4,1/2,Final на победителях (для теста)
DROP PROCEDURE IF EXISTS generate_champions_fixtures$$
CREATE PROCEDURE generate_champions_fixtures(IN p_season_id INT, IN p_start_date DATE)
BEGIN
  DECLARE group_stage_id INT;
SELECT id INTO group_stage_id FROM tournaments_stages WHERE tournaments_season_id=p_season_id AND type='group_stage' LIMIT 1;
-- get grp stage id list (there are 4 groups rows in tournaments_groups)
DROP TEMPORARY TABLE IF EXISTS grp_ids;
  CREATE TEMPORARY TABLE grp_ids (gid INT AUTO_INCREMENT PRIMARY KEY, stage_group_id INT, name VARCHAR(50));
INSERT INTO grp_ids(stage_group_id,name)
SELECT id,name FROM tournaments_groups WHERE stage_id = group_stage_id ORDER BY id;

-- assign teams 1..16 to groups sequentially: 1->A,2->B,3->C,4->D,5->A...
DROP TEMPORARY TABLE IF EXISTS grp_teams;
  CREATE TEMPORARY TABLE grp_teams (gid INT, team_id INT);
  DECLARE i INT DEFAULT 1;
  WHILE i <= 16 DO
    INSERT INTO grp_teams(gid, team_id)
SELECT ((i-1) % 4) + 1, i; -- gid:1..4
SET i = i + 1;
END WHILE;

  -- For each group, produce double round robin (each plays home and away)
  DECLARE g INT DEFAULT 1;
  DECLARE d DATETIME;
  SET d = p_start_date;
  WHILE g <= 4 DO
    -- get teams in group g (4 teams)
    DROP TEMPORARY TABLE IF EXISTS teams_in_g;
    CREATE TEMPORARY TABLE teams_in_g AS SELECT team_id FROM grp_teams WHERE gid = g ORDER BY team_id;
-- generate matches: pair every pair twice (home/away)
DECLARE a INT DEFAULT 1;
    DECLARE b INT;
    DECLARE tcount INT;
SELECT COUNT(*) INTO tcount FROM teams_in_g;
WHILE a <= tcount DO
      SET b = a + 1;
      WHILE b <= tcount DO
        -- first leg
        INSERT INTO tournaments_matches(stage_id, group_id, team_1, team_2, `date`, score_1, score_2, status)
        VALUES(group_stage_id, (SELECT stage_group_id FROM grp_ids WHERE gid = g),
               (SELECT team_id FROM (SELECT * FROM teams_in_g) x LIMIT 1 OFFSET (a-1)),
               (SELECT team_id FROM (SELECT * FROM teams_in_g) y LIMIT 1 OFFSET (b-1)),
               DATE_ADD(d, INTERVAL (a*2 + b) DAY),
               rand_goal(), rand_goal(), 'played');
        -- second leg (swap)
INSERT INTO tournaments_matches(stage_id, group_id, team_1, team_2, `date`, score_1, score_2, status)
VALUES(group_stage_id, (SELECT stage_group_id FROM grp_ids WHERE gid = g),
       (SELECT team_id FROM (SELECT * FROM teams_in_g) y LIMIT 1 OFFSET (b-1)),
      (SELECT team_id FROM (SELECT * FROM teams_in_g) x LIMIT 1 OFFSET (a-1)),
    DATE_ADD(d, INTERVAL (a*2 + b + 7) DAY),
    rand_goal(), rand_goal(), 'played');
SET b = b + 1;
END WHILE;
      SET a = a + 1;
END WHILE;

    SET g = g + 1;
END WHILE;

  -- After group stage, pick top2 from each group by simple random winners (for demo)
  -- For test data we'll just select 8 teams (first two per group by team_id order)
  DROP TEMPORARY TABLE IF EXISTS qualified;
  CREATE TEMPORARY TABLE qualified (pos INT AUTO_INCREMENT PRIMARY KEY, team_id INT);
INSERT INTO qualified(team_id)
SELECT team_id FROM grp_teams WHERE gid IN (1) ORDER BY team_id LIMIT 2;
INSERT INTO qualified(team_id)
SELECT team_id FROM grp_teams WHERE gid IN (2) ORDER BY team_id LIMIT 2;
INSERT INTO qualified(team_id)
SELECT team_id FROM grp_teams WHERE gid IN (3) ORDER BY team_id LIMIT 2;
INSERT INTO qualified(team_id)
SELECT team_id FROM grp_teams WHERE gid IN (4) ORDER BY team_id LIMIT 2;

-- Quarterfinals: pair 1v8,2v7,3v6,4v5
DECLARE qf_stage INT;
  DECLARE sf_stage INT;
  DECLARE final_stage INT;
SELECT id INTO qf_stage FROM tournaments_stages WHERE tournaments_season_id=p_season_id AND name LIKE '%1/4%' LIMIT 1;
SELECT id INTO sf_stage FROM tournaments_stages WHERE tournaments_season_id=p_season_id AND name LIKE '%1/2%' LIMIT 1;
SELECT id INTO final_stage FROM tournaments_stages WHERE tournaments_season_id=p_season_id AND type='final' LIMIT 1;

SET i = 1;
  WHILE i <= 4 DO
    INSERT INTO tournaments_matches(stage_id, group_id, team_1, team_2, `date`, score_1, score_2, status)
SELECT qf_stage, NULL,
       (SELECT team_id FROM qualified WHERE pos = i),
       (SELECT team_id FROM qualified WHERE pos = (9 - i)),
       DATE_ADD(p_start_date, INTERVAL (i*2) DAY),
       rand_goal(), rand_goal(), 'played';
SET i = i + 1;
END WHILE;

  -- SF
  DROP TEMPORARY TABLE IF EXISTS qf_winners;
  CREATE TEMPORARY TABLE qf_winners (pos INT AUTO_INCREMENT PRIMARY KEY, team_id INT);
INSERT INTO qf_winners(team_id)
SELECT CASE WHEN m.score_1 >= m.score_2 THEN m.team_1 ELSE m.team_2 END
FROM tournaments_matches m WHERE m.stage_id = qf_stage ORDER BY m.id;

SET i = 1;
  WHILE i <= 2 DO
    INSERT INTO tournaments_matches(stage_id, group_id, team_1, team_2, `date`, score_1, score_2, status)
SELECT sf_stage, NULL,
       (SELECT team_id FROM qf_winners WHERE pos = (2*i -1)),
       (SELECT team_id FROM qf_winners WHERE pos = (2*i)),
       DATE_ADD(p_start_date, INTERVAL (i*5) DAY),
       rand_goal(), rand_goal(), 'played';
SET i = i + 1;
END WHILE;

  -- Final
  DROP TEMPORARY TABLE IF EXISTS sf_winners;
  CREATE TEMPORARY TABLE sf_winners (pos INT AUTO_INCREMENT PRIMARY KEY, team_id INT);
INSERT INTO sf_winners(team_id)
SELECT CASE WHEN m.score_1 >= m.score_2 THEN m.team_1 ELSE m.team_2 END
FROM tournaments_matches m WHERE m.stage_id = sf_stage ORDER BY m.id;

INSERT INTO tournaments_matches(stage_id, group_id, team_1, team_2, `date`, score_1, score_2, status)
SELECT final_stage, NULL,
       (SELECT team_id FROM sf_winners WHERE pos = 1),
       (SELECT team_id FROM sf_winners WHERE pos = 2),
       DATE_ADD(p_start_date, INTERVAL 40 DAY),
       rand_goal(), rand_goal(), 'played';

DROP TEMPORARY TABLE IF EXISTS grp_ids;
  DROP TEMPORARY TABLE IF EXISTS grp_teams;
  DROP TEMPORARY TABLE IF EXISTS teams_in_g;
  DROP TEMPORARY TABLE IF EXISTS qualified;
  DROP TEMPORARY TABLE IF EXISTS qf_winners;
  DROP TEMPORARY TABLE IF EXISTS sf_winners;
END$$

DELIMITER ;

-- ==========================
-- 7) Вызовы процедур для заполнения данных (2 сезона: 2022/23 и 2023/24)
-- ==========================
-- Чемпионат: сезоны id=1 и id=2 (с датой старта)
CALL generate_league_fixtures(1, '2022-08-01');
CALL generate_league_fixtures(2, '2023-08-01');

-- Кубок: сезоны id=3 и 4 (используем top16)
CALL generate_cup_bracket(3, '2022-09-01');
CALL generate_cup_bracket(4, '2023-09-01');

-- Суперкубок: сезоны id=5 и 6 (один матч)
CALL generate_supercup_match(5, 1, 2, '2022-07-10 19:00:00');
CALL generate_supercup_match(6, 3, 4, '2023-07-10 19:00:00');

-- Лига Чемпионов: сезоны id=7 и 8
CALL generate_champions_fixtures(7, '2022-09-15');
CALL generate_champions_fixtures(8, '2023-09-15');

-- ==========================
-- 8) Примеры запросов для проверки
-- ==========================
-- Общее количество матчей:
SELECT COUNT(*) AS total_matches FROM tournaments_matches;

-- Матчи чемпионата сезона 2022/23 (stage ids for season 1):
SELECT m.id, s.name AS stage, m.team_1, t1.name AS team1_name, m.team_2, t2.name AS team2_name, m.date, m.score_1, m.score_2
FROM tournaments_matches m
         JOIN tournaments_stages s ON s.id = m.stage_id
         LEFT JOIN teams t1 ON t1.id = m.team_1
         LEFT JOIN teams t2 ON t2.id = m.team_2
WHERE s.tournaments_season_id = 1
ORDER BY m.date LIMIT 50;

-- Просмотреть групповые матчи ЛЧ сезона 7:
SELECT m.*, g.name AS group_name FROM tournaments_matches m
                                          JOIN tournaments_stages s ON s.id = m.stage_id
                                          LEFT JOIN tournaments_groups g ON g.id = m.group_id
WHERE s.tournaments_season_id = 7 AND s.type='group_stage'
ORDER BY g.name, m.date LIMIT 100;

-- ==========================
-- Конец файла
-- ==========================
