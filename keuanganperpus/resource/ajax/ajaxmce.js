/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
       function addMCE()
       {
            tinyMCE.execCommand('mceRemoveControl',false,'id_news_text');
        tinyMCE.init({
            theme:'advanced',
            mode:'none'
        });
        tinyMCE.execCommand('mceAddControl',false,'id_news_text');
        }


         $("textarea.tinymce").tinymce({
         script_url : getBaseURL()+"resource/js/tiny_mce/tiny_mce.js",

               mode : "none",
               theme : "advanced",
                skin : "o2k7",
             plugins : "spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        //theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

            theme_advanced_buttons3_add : "media",
            theme_advanced_toolbar_location : "top",
            theme_advanced_toolbar_align : "left",
            extended_valid_elements : "hr[class|width|size|noshade]",
            file_browser_callback : "ajaxfilemanager",
            paste_use_dialog : false,
            theme_advanced_resizing : true,
            theme_advanced_resize_horizontal : true,
            apply_source_formatting : true,
            force_br_newlines : true,
            force_p_newlines : false,
            relative_urls : true

                });
            });


        function ajaxfilemanager(field_name, url, type, win) {
            //var ajaxfilemanagerurl = "../../../resource/js/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php";
            //var ajaxfilemanagerurl = getBaseURL()+"resource/js/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php";
             var ajaxfilemanagerurl = getBaseURL()+"resource/js/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php";
            switch (type) {
                case "image":
                    break;
                case "media":
                    break;
                case "flash":
                    break;
                case "file":
                    break;
                default:
                    return false;
            }

            tinyMCE.activeEditor.windowManager.open({
               // url: "../../../resource/js/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php",
                //url: getBaseURL()+"resource/js/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php",
                url:getBaseURL()+"resource/js/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php",
                width: 700,
                height: 540,
                inline : "yes",
                modal:true,
                close_previous : "no",
                overlay: {
                backgroundColor:"#000000",
                opacity:.75
                         },
               open: function() {
                setTimeout('addMCE()',2000);
            },
            beforeclose:
                function(){
                    tinyMCE.execCommand('mceRemoveControl',false,'id_news_text');
                }

            },{
                window : win,
                input : field_name
            });


        }

