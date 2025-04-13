﻿<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Painel Administrativo</title>
    <?php
    $id = isset($_GET['id']) && !empty($_GET['id']) ? $_GET['id'] : false;
    require_once '../../_php/Render.php';
    $render = new Render();
    $render->renderHead();
    ?>
</head>

<body style="background-color: #FAFBFC;">

    <?php $render->renderHeader(); ?>

    <div class="container-fluid">
        <div class="row full-screen">
            <?php
            $render->renderMain('municipio', 'view-cadastro');
            $render->renderFooter();
            ?>
        </div><!-- full screen  -->
    </div><!-- container-fluid -->

</body>

    <script src="https://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script> 

<?php
$render->renderScripts(array('Municipio', 'EntidadeInfo'));
$render->renderScriptsOnload(array('razaoSocial' => array('')));
if ($id) {
    $render->renderScriptsOnload(array('populaForm' => array($id)));
}
?>

<!-- <script src="../_js/tinymce/5.0.4/tinymce.min.js"></script> 

<script src="https://cdn.tiny.cloud/1/bpw7icuj2r6ncv4ygunavoa1argh2n6mar2dbjbhl8wjewu6/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> 

<script>
    tinymce.init({
        selector: "textarea",
        plugins: "code print preview importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons",
        menubar: "file edit view insert format tools table tc help",
        toolbar: "code | undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen preview save print | insertfile image template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment",
        autosave_ask_before_unload: true,
        extended_valid_elements: "iframe[src|frameborder|style|scrolling|class|width|height|name|align]",
        autosave_interval: "30s",
        autosave_prefix: "{path}{query}-{id}-",
        autosave_restore_when_empty: false,
        autosave_retention: "2m",
        image_advtab: true,
        link_list: [{
                title: "My page 1",
                value: "https://www.tiny.cloud"
            },
            {
                title: "My page 2",
                value: "http://www.moxiecode.com"
            },
        ],
        image_list: [{
                title: "My page 1",
                value: "https://www.tiny.cloud"
            },
            {
                title: "My page 2",
                value: "http://www.moxiecode.com"
            },
        ],
        image_class_list: [{
                title: "None",
                value: ""
            },
            {
                title: "Some class",
                value: "class-name"
            },
        ],
        importcss_append: true,
        templates: [{
                title: "New Table",
                description: "creates a new table",
                content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>',
            },
            {
                title: "Starting my story",
                description: "A cure for writers block",
                content: "Once upon a time...",
            },
            {
                title: "New list with dates",
                description: "New List with dates",
                content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>',
            },
        ],
        template_cdate_format: "[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]",
        template_mdate_format: "[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]",
        height: 600,
        image_caption: true,
        quickbars_selection_toolbar: "bold italic | quicklink h2 h3 blockquote quickimage quicktable",
        noneditable_noneditable_class: "mceNonEditable",
        toolbar_mode: "sliding",
        spellchecker_ignore_list: ["Ephox", "Moxiecode"],
        tinycomments_mode: "embedded",
        content_style: "body img.md\\:float-right{ float: right; }; @import url('https://fonts.googleapis.com/css2?family=Oswald&display=swap'); @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap'); @import url('https://fonts.googleapis.com/css2?family=Roboto&family=Roboto+Slab&display=swap'); @import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap'); body { font-family: Roboto; };",
        contextmenu: "link image in",
        a11y_advanced_options: true,
        mentions_selector: ".mymention",
        mentions_item_type: "profile",
        font_formats: "Andale Mono=andale mono,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black,avant garde; Book Antiqua=book antiqua,palatino; Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago; Oswald=oswald; Roboto=roboto; Roboto Slab=roboto slab; Symbol=symbol; Serif=sans-serif; Tahoma=tahoma,arial,helvetica,sans-serif; Terminal=terminal,monaco; Times New Roman=times new roman,times; Trebuchet MS=trebuchet ms,geneva; Verdana=verdana,geneva; Webdings=webdings; Wingdings=wingdings,zapf dingbats",
        fontsize_formats: "8pt 10pt 10.5pt 12pt 14pt 16pt 18pt 20pt 21pt 22pt 24pt 26pt 28pt 30pt 32pt 34pt 36pt 38pt 40pt",
        textpattern_patterns: [{
                start: "#",
                format: "h1"
            },
            {
                start: "##",
                format: "h2"
            },
            {
                start: "###",
                format: "h3"
            },
            {
                start: "####",
                format: "h4"
            },
            {
                start: "#####",
                format: "h5"
            },
            {
                start: "######",
                format: "h6"
            },
            {
                start: "* ",
                cmd: "InsertUnorderedList"
            },
            {
                start: "- ",
                cmd: "InsertUnorderedList"
            },
            {
                start: "1. ",
                cmd: "InsertOrderedList",
                value: {
                    "list-style-type": "decimal"
                },
            },
            {
                start: "1) ",
                cmd: "InsertOrderedList",
                value: {
                    "list-style-type": "decimal"
                },
            },
            {
                start: "a. ",
                cmd: "InsertOrderedList",
                value: {
                    "list-style-type": "lower-alpha"
                },
            },
            {
                start: "a) ",
                cmd: "InsertOrderedList",
                value: {
                    "list-style-type": "lower-alpha"
                },
            },
            {
                start: "i. ",
                cmd: "InsertOrderedList",
                value: {
                    "list-style-type": "lower-roman"
                },
            },
            {
                start: "i) ",
                cmd: "InsertOrderedList",
                value: {
                    "list-style-type": "lower-roman"
                },
            },
            {
                start: "---",
                replacement: "<hr/>"
            },
            {
                start: "--",
                replacement: "—"
            },
            {
                start: "-",
                replacement: "—"
            },
            {
                start: "(c)",
                replacement: "©"
            },
            {
                start: "//brb",
                replacement: "Be Right Back"
            },
            {
                start: "//heading",
                replacement: '<h1 style="color: blue">Heading here</h1> <h2>Author: Name here</h2> <p><em>Date: 01/01/2000</em></p> <hr />',
            },
            {
                start: "*",
                end: "*",
                format: "italic"
            },
            {
                start: "**",
                end: "**",
                format: "bold"
            },
        ],

        /*image_class_list: [
                  {title: 'Responsive', value: 'img-responsive'}
              ],*/
        image_title: true,
        automatic_uploads: true,
        file_picker_types: "image"
    });
</script> -->

</html>