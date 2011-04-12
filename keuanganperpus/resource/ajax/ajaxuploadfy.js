/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
    $('#edgambar').uploadify({
        'uploader' : getBaseURL()+'resource/js/uploadify/uploadify.swf',
        'script':getBaseURL()+'resource/js/uploadify/uploadify.php',
        //\'script\': \'' . site_url() . '/ctrupload/uploadfile/\',
        'folder': './resource/uploaded',
        'multi' : true,
        'auto'  : true,
        'fileExt' : '*.jpg;*.jpeg;*.png;*.gif',
        'buttonText': 'Browse...',
        'cancelImg': getBaseURL()+'resource/js/uploadify/cancel.png',
        'onError' : function (a, b, c, d) {
            if (d.status == 404)
                alert('Could not find upload script.');
            else if (d.type === "HTTP")
                alert('error '+d.type+": "+d.status);
            else if (d.type ==="File Size")
                alert(c.name+' '+d.type+' Limit: '+Math.round(d.sizeLimit/1024)+'KB');
            else
                alert('error '+d.type+": "+d.text);
        },
        'onComplete'     : function(event, queueID, fileObj, response, data) {


            // var img_gal = $(\'<img>\').attr({
            $('#previewg').attr({
                src:  getBaseURL()+"resource/uploaded/"+fileObj.name,
                alt: fileObj.name
            }).css({
                position : "relative",
                top :-30,
                height: "50px",
                left:"150px",
                width : "50px"


            });
            //var a_gal = $(\'#preview\').attr({
            $('#preview').attr({
                href: getBaseURL()+"resource/uploaded/"+fileObj.name,

                class : "thickbox",
                alt: fileObj.name,
                title: fileObj.name
            }).css({
                top :-30,
                position : "relative",
                height: "50px",
                width : "50px",
                left:"50px",
                left:"150px"
            });
            $('#edidgambar').val(fileObj.name);

        // a_gal.append(img_gal);
        // $(\'#gambar\').empty();
        // $(\'#gambar\').append(a_gal);


        // setImage("' . base_url() . 'resource/uploaded/"+fileObj.name);

        },
        'onAllComplete'     : function() {
        // setImage(fileObj[\'name\']);

        }

    });
});

