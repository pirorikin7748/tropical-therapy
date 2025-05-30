// 商品詳細ページのSwiperスライダー初期化
document.addEventListener('DOMContentLoaded', () => {
    const swiper = new Swiper('.swiper', {
        loop: true,
        pagination: {
            el: '.swiper-pagination',
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });

    //ログインしていないユーザーはログインページへリダイレクト
    const container = document.querySelector('.product-detail-page');
    const isGuest = container?.dataset.isGuest === 'true';

    const form = document.getElementById('add-to-cart-form');
    if (form && isGuest) {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            alert('ログインが必要です。ログインページへ移動します。');
            window.location.href = '/login';
        });
    }
});