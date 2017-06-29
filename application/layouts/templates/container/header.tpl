<header>
    {assign var='page' value="{substr($this->url(), 1)}"}

    <div class="demo-header">
        <h3>Démo ZF</h3>
    </div>
    <div class="ui pointing menu">
        <a id="menu-home" class="item" href="index">Accueil</a>
        <a id="menu-passport" class="item" href="passport">Passport</a>
        <a id="menu-race" class="item" href="race">Race</a>
        <a id="menu-espece" class="item" href="espece">Espèce</a>
        <a id="menu-animal" class="item" href="animal">Animal</a>
        <div class="right menu">
            <div class="item">
                <div class="ui transparent icon input">
                    <input type="text" placeholder="Lancer une recherche...">
                    <i class="search link icon"></i>
                </div>
            </div>
        </div>
    </div>
</header>

<script type="text/javascript">
    var page = "{$page}";
    var tab_current = (page!='') ? 'a#menu-'+ page : 'a#menu-home';

    $(document).ready(function(){
        $(tab_current).addClass('active');
    });
</script>