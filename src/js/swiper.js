window.addEventListener('load', function (event) {

    $('.brand-card').on('click', function (){
        if ($(window).width() > 767){
            return
        }

        $(this).toggleClass('active')
    })


    new Splide('.splide', {
        type: 'loop',
        perPage: 5,
        lazyLoad: 'nearby',
        drag: 'free',
        // padding: 10,
        gap: 24,
        breakpoints: {
            1699: {
                perPage: 4,
                gap: 16
            },
            1339: {
                perPage: 3,

            },
            640: {
                drag: true,
                perPage: 2,

            },
            440: {
                // autoWidth: true,
                perPage: 1,
            },
        }
    }).mount();

});
