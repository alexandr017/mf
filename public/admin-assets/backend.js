 $(document).ready(function(){


    $('li').on('click',function(){
    	$(this).find('.treeview-menu').toggle();
    });


    $('.destroy').click(function(e){
        e.preventDefault();
        if (confirm("Вы действительно хотите удалить текущий элемент?")) {
            var src = $(this).attr('href');
            location.href = src;
        }
    });

    // Используем делегирование событий для динамически созданных элементов (DataTables)
    $(document).on('click', '.rest-destroy', function(e){
        if (!confirm("Вы действительно хотите удалить текущий элемент?")) {
            e.preventDefault();
            return false;
        }
    });

    $('.translate').on('click',function(){
        console.log('1');
        translit('#h1','#alias');
    });

});




function translit(inSeletor,outSelector){
var space = '-'; 
var text = $(inSeletor).val().toLowerCase();
     
var transl = {
'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'e', 'ж': 'zh', 
'з': 'z', 'и': 'i', 'й': 'j', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n',
'о': 'o', 'п': 'p', 'р': 'r','с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'h',
'ц': 'c', 'ч': 'ch', 'ш': 'sh', 'щ': 'sh','ъ': space, 'ы': 'y', 'ь': space, 'э': 'e', 'ю': 'yu', 'я': 'ya',
' ': space, '_': space, '`': space, '~': space, '!': space, '@': space,
'#': space, '$': space, '%': space, '^': space, '&': space, '*': space, 
'(': space, ')': space,'-': space, '\=': space, '+': space, '[': space, 
']': space, '\\': space, '|': space, '/': space,'.': space, ',': space,
'{': space, '}': space, '\'': space, '"': space, ';': space, ':': space,
'?': space, '<': space, '>': space, '№':space
}
                
var result = '';
var curent_sim = '';
                
for(i=0; i < text.length; i++) {
    if(transl[text[i]] != undefined) {
         if(curent_sim != transl[text[i]] || curent_sim != space){
             result += transl[text[i]];
             curent_sim = transl[text[i]];
                                                        }                                                                             
    }
    else {
        result += text[i];
        curent_sim = text[i];
    }                              
}          
                
result = result.replace(/^-/, '');          
result = result.replace(/-$/, '');         
                
$(outSelector).val(result); 
    
}


var url = document.URL;
if((url.indexOf('create')+ 1) || (url.indexOf('edit')+ 1)){
    jQuery(window).bind(
        "beforeunload", 
        function() { 
            alert(document.URL);
            return confirm("Do you really want to close?") 
        }
    );
}

let $$ = function (selector) {
    return document.querySelectorAll(selector);
}
 console.log($$('.table-toggle-btn'));
 $$('.table-toggle-btn').forEach((button) => {
     button.addEventListener('click', () => {
         if (button.classList.contains('down')) {
             button.classList.add('up');
             button.classList.remove('down');
             button.textContent = 'Скрыть';
             button.previousSibling.querySelectorAll('tr.hide').forEach((tr) => {
                 tr.classList.add('show');
                 tr.classList.remove('hide');
             });
             if (button.closest('.panel') != null) {
                 button.closest('.panel').style.maxHeight = 'fit-content';
             }
         } else {
             button.classList.add('down');
             button.classList.remove('up');
             button.textContent = 'Показать всё';
             button.previousSibling.querySelectorAll('tr.show').forEach((tr) => {
                 tr.classList.add('hide');
                 tr.classList.remove('show');
             });
         }
     });
 });


