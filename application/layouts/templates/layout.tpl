{nocache}
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Demo ZF</title>
    <link rel="stylesheet" type="text/css" href="medias/css/Semantic-UI/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="medias/js/DataTables/media/css/dataTables.semanticui.min.css">
    <link rel="stylesheet" type="text/css" href="medias/css/theme.css" />
    <!-- On inclus le CSS du Contôleur courant -->
    {$this->headLink()->appendStylesheet("medias/css/screens/{$this->url()}.css")}
    <!-- Librairies utiles -->
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="medias/js/DataTables/media/js/jquery.dataTables.min.js"></script>
    <script src="medias/js/DataTables/media/js/dataTables.semanticui.min.js"></script>
    <script src="medias/css/Semantic-UI/semantic.min.js"></script>
    <script src="medias/js/default.js"></script>
</head>

<body>
    <!-- Déclaration des variables utiles -->
    {assign var='container_dir' value="{APPLICATION_PATH}/layouts/templates/container/"}
    <div id="page">
        <!-- Section HEADER -->
        {include file="{$container_dir}header.tpl" nocache}
        <!-- Section CONTENT -->
        <section id="welcome">
            {$this->layout()->content}
        </section>
    </div>
    <!-- Section FOOTER -->
    {include file="{$container_dir}footer.tpl" nocache}
</body>
</html>
{/nocache}