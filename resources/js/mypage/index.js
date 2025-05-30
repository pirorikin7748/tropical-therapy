import shopImage from '../../images/shop.png';

document.addEventListener('DOMContentLoaded', () => {
    console.log("mypage/index.js loaded");

    // ✅ DOMが構築された後に背景を設定する
    document.body.style.backgroundImage = `url(${shopImage})`;
    document.body.style.backgroundSize = '1200px auto';
    document.body.style.backgroundPosition = 'center top';
    document.body.style.backgroundRepeat = 'no-repeat';
    document.body.style.backgroundAttachment = 'fixed';

    console.log("mypage/index.js loaded");
});