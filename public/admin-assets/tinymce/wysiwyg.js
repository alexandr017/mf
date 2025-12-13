function tInit(selector){

  tinymce.init({
  language: 'ru',
  selector: selector,
  height: 500,
  'force_p_newlines' : false,
  'forced_root_block' : false,
  force_br_newlines : true,
  protect: [/[\n\f\r\t\v]/g],
  verify_html : false,
  valid_elements: '*[*]',
  /*valid_elements : 'math[xmlns|display],mrow[class],mi[mathvariant],mfrac,mn,mtable[rowspacing|columnspacing],mo,mtr,mtd,munderover',*/
  plugins: [
    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime media nonbreaking save table contextmenu directionality',
    'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc',
    'formula',
    'syntaxhighlight'
  ],
  relative_urls: false,
  convert_urls: false,
  toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  toolbar2: 'print preview media | forecolor backcolor emoticons | codesample | formula | syntaxhighlight | template',
  image_advtab: true,
  templates: [
    { title: 'Яндекс RTB', content: '[ya_RTB height="180" width="100%"][/ya_RTB]' },
    { title: 'Меню', content: "[content_item_wrap]\n[content_item img=\"/images/banki/tochka.png\" link=\"#1\" link_title=\"1 место\"]Текст[/content_item]\n[content_item img=\"/images/#\" link=\"#2\" link_title=\"2 место\"]Текст[/content_item]\n[content_item img=\"/images/#\" link=\"#3\" link_title=\"3 место\"]Текст[/content_item]\n[content_item img=\"/images/#\" link=\"#4\" link_title=\"4 место\"]Текст[/content_item]\n[content_item img=\"/images/#\" link=\"#5\" link_title=\"5 место\"]Текст[/content_item]\n[content_item img=\"/images/#\" link=\"#6\" link_title=\"6 место\"]Текст[/content_item]\n[content_item img=\"/images/#\" link=\"#7\" link_title=\"7 место\"]Текст[/content_item]\n[content_item img=\"/images/#\" link=\"#8\" link_title=\"8 место\"]Текст[/content_item]\n[content_item img=\"/images/#\" link=\"#9\" link_title=\"9 место\"]Текст[/content_item]\n[content_item img=\"/images/#\" link=\"#10\" link_title=\"10 место\"]Текст[/content_item]\n [/content_item_wrap]"},
    { title: 'Фоновый блок', content: '[bg_block color=""][/bg_block]' },
    { title: 'Подробное описание', content: '[offer_in_rating title="Текcт" place="1" img="/images/#" link="#" text="#"]\n[bg_block color=""]\nТекcт\n[/bg_block]\n[of_rat_block img="#" title="Условия" rating="5.5"]Текст[/of_rat_block]\n[of_rat_block img="#" title="Оформление" rating="5.5"]Текст[/of_rat_block]\n[of_rat_block img="#" title="Услуги для ООО" rating="4.5"]Текст[/of_rat_block]\n[of_rat_block img="#" title="Надежность" rating="4.5"]Текст[/of_rat_block]\n[of_rat_block img="#" title="Удобство" rating="5.5"]Текст[/of_rat_block]\n[big_star_list]\nТекст\n[/big_star_list]\n[of_rat_plus]Текст[/of_rat_plus]\n[of_rat_minus]Текст[/of_rat_minus]\n[/offer_in_rating]\n' },
    { title: 'Аккордеон', content: '[vsezaimy_accordion][vsezaimy_accordion_item title="Название кнопки аккордиона"]Скрытый текст аккордиона[/vsezaimy_accordion_item][/vsezaimy_accordion]' },
    { title: 'Одиночная кнопка', content: '[short_button link="#"]' },
    { title: 'Сообщение (Зеленое)', content: '[vsezaimy_important]Сообщение с зеленой иконкой[/vsezaimy_important]' },
    { title: 'Сообщение (Синее)', content: '[vsezaimy_info]Сообщение с синей иконкой[/vsezaimy_info]' },
    { title: 'Краткий обзор', content: '[rat_block_wrap][rat_block rating="4.5" title="Условия" img="#"]Текст[/rat_block][rat_block rating="5.5" title="Использование" img="#"]Текст[/rat_block] [rat_block rating="4.5" title="Бонусы" img="#"]Текст[/rat_block] [rat_block rating="4.5" title="Доступность" img="#"]Текст[/rat_block][pros title="Удобное оформление по двум документам"]Текст[/pros][pros title="Недорогое обслуживание карты"]Текст[/pros][cons title="Неудобное оформление рассрочки"]Текст[/cons][cons title="Неудобное оформление рассрочки"]Текст[/cons][/rat_block_wrap]' },
    { title: 'Google Trends', content: '[google_trends title="Текст"]' },
    { title: 'Карточки:max_sum', content: '[max_sum]' },
    { title: 'Карточки:carts_count', content: '[carts_count]' },
    { title: 'Карточки:max_day', content: '[max_day]' },
    { title: 'Карточки:min_percent', content: '[min_percent]' },
    { title: 'Карточки:max_limit', content: '[max_limit]' },
    { title: 'Карточки:min_maintenance', content: '[min_maintenance]' },
    { title: 'Карточки:max_maintenance', content: '[max_maintenance]' },
    { title: 'Карточки:ostatok_on_percent', content: '[ostatok_on_percent]' },
  ],
  /*
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css'
  ]*/
 });

}
