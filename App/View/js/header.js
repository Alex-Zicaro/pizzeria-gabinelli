/* PRINCIPES DU FONTIONS SITE
 - toutes les instructions habituelles doiventa ller dans site_init();
 - les instructions liées à smoothstate doivent s'initialiser dans site_onPageLoad()
 - pour le chgt de page en AJAX, caler des update / restart dans le site_onAjaxLoad
 */

/*//  DEMARRAGE ///////////////////////////////*/
$.jgo.prm = {
    defaultActiveClass	: 'active',
    replaceSVGtoPNG		: true,
    aspireSVG			: true,
    handleIframeWmode	: true,
    watchScroll			: true,
	scrollPoint			: 0
};

$(document).ready(function(){
    $.jgo.init();
    site_init();
    //POUR ACTIVER LE DPE EN POPUP DECOMMENTER LA LIGNE
   // $('#dpe').jalisDpe();

   var magasin = $('.myintro .windows');

    $('.myintro #img-1').addClass('activated');

    $(magasin).hover(function () {

        let activeImage = 'img-' + this.id;
        let elements = '.myintro #' + activeImage;
        $(elements).addClass('activated');


    });

    $(magasin).mouseout(function () {
        let activeImage = 'img-' + this.id;
        let elements = '.myintro #' + activeImage;


        $(elements).removeClass('activated');
    });

});

$(window).on( "load",  site_onPageLoad);


/*//  INITIALISATION  ///////////////////////////////
 -> tous les codes qui s'executent au demarrage
 */



function site_init(){

    //img lazy
    $.site.imgLazy = new $.jgo.lazyloaderAll();
    $(window).scrollEnd(function(){
        $.site.imgLazy.load();
    }, 10);

    $('body').addClass('ready');
    // cas ios7
    if (is_iOs()) { $('html').addClass('badios');}


    if ($.jgo.elementExiste('.detection-laius')) {
        $('body').addClass('detection-laius');
    }

    /*///// CODE JQUERY HORS JGO*//////

    /* AJOUTE UNE CLASSE is-scrolled au header quand le menu est scrollé (mobile) */
    $('nav.nav > ul').on('scroll', function(e){
        if ($('nav.nav > ul').scrollTop() > 0){
            $('header').addClass('is-scrolled');
        }else{
            $('header').removeClass('is-scrolled');
        }
    });
	
	
	
    /* AJOUTE OU ENLEVE une classe au body selon si le menu doit apparaitre ou non */
    $('input[name="ouvre-menu"]').off('change');
    $('input[name="ouvre-menu"]').on('change', function(e){
        var inp = $(this);
        if(inp.prop('checked') == true){
            $('body').addClass('menu-active');
        }else{
            $('body').removeClass('menu-active');
        }
    });

    // scrolle la fenetre toujours en bas de page quand on altère le checkbox du pdp (bug sous EDGE : le site remonte en haut dès qu'on clique)
    $('input[name="ouvre-footer"]').off('change');
    $('input[name="ouvre-footer"]').on('change', function(e){
        $('html, body').scrollTop($(document).height());
    });

    //retrait de l'intro une fois le scroll fait
    if ($('body').hasClass('accueil')) {
        $(window).scroll(function () {
            if ($(window).scrollTop() >= $(window).height() && $.jgo.elementExiste('.intro')) {
                $('.intro').remove();
                $('body, html').scrollTop(0);
                $.jgo.prm.scrollPoint = $('nav.nav').offset().top;
            }
        });
    }


    if ($.jgo.elementExiste('#delete_sort')) {
    $([document.documentElement, document.body]).animate( {
    scrollTop: $("#delete_sort").offset().top - 200}, 500);
    }



    // rajoute un flex end quand il n'y a qu'un enfant dans la pagination
    /*$('.bts--flex.pagination').each(function(){
     var bloc = $(this);
     if(bloc.children('*').length == 1 && bloc.children('.pagination').length == 1){
     bloc.children('*').addClass('margin-auto-left');
     }
     });*/
	
	
	

	/*///// CODE SLICK /////*/
	$('.diaporama, .diaporama--accueil, .diaporama--laius, .diaporama--intro, .diaporama--fond').slick({
        dots: false,
        lazyLoad: 'ondemand',  // a décommenter pour gagner en perf
        infinite: true,
        arrows: false,
        speed: 700,
        fade: true,
        cssEase: 'linear',
        autoplay: true,
        autoplaySpeed: 5000,
        pauseOnHover: false,
    });

	if ($.jgo.elementExiste('.diaporama--fiche')) {

        $(".diaporama--fiche").slick({
            /*pauseOnHover:true,*/
            lazyLoad: 'ondemand', 
            dots: false,
            infinite: true,
            arrows: true,
            speed: 700,
            fade: true,
            cssEase: 'linear',
            autoplay: true,  // a commenter pour avoir une transition horizontal
            autoplaySpeed: 5000,
            pauseOnHover: false,

            // responsive: [ 
            //  {
            //      breakpoint: 640,
            //      settings: {
            //          centerMode: true,
            //          centerPadding: '60px',
            //          arrows: false,
            //          fade: false,
            //          autoplay:false,
            //          slidesToShow: 1,
            //          speed: 300,
            //          adaptiveHeight: true 
            //      }
            //  }
            // ]


        });

    }

	if ($.jgo.elementExiste('.slideshow')) {

		$(".slideshow").slick({
			lazyLoad: 'anticipated', // ondemand progressive anticipated
			infinite: false,
			arrows: true,
			autoplay:true,
			autoplaySpeed: 6000,
			pauseOnHover:true,

			responsive: [
				{
					breakpoint: 600,
					settings: {
						adaptiveHeight: true
					}
				}
			]


		});

	}

    $('.center').slick({
        centerMode: true,
        centerPadding: '15%',
        slidesToShow: 1,
        arrows: true,
        dots: true,
        autoplay: true,  // a commenter pour avoir une transition horizontal
        autoplaySpeed: 6000,
        pauseOnHover: false,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
            }
        ]
    });






















