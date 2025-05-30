document.addEventListener('DOMContentLoaded', async () => {
    const stripe = Stripe(window.stripePublicKey);//stripeオブジェクトのインスタンス生成
    const elements = stripe.elements();
    //カードのフォームパーツ作成
    const card = elements.create('card', {
        hidePostalCode: true
    });
    card.mount('#card-element');//cardをcard-elementの場所に埋め込む

    const form = document.getElementById('payment-form');
    const submitBtn = document.getElementById('submit-button');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();//一旦送信キャンセル（トークン作ってないため）
        submitBtn.disabled = true;//購入ボタンの無効化

        //stripeサーバに情報を送って支払いトークンを作成。成功⇒paymentMethodにデータ入る
        const { error, paymentMethod } = await stripe.createPaymentMethod({
            type: 'card',
            card: card,
        });

        //エラーがあったらアラート出して処理を中止
        if (error) {
            alert(error.message);
            submitBtn.disabled = false;
            return;
        }

        //paymentMethod.idをhiddenフィールドにセットしトークンを含んだフォームを送信
        document.getElementById('payment-method').value = paymentMethod.id;
        console.log('フォーム送信します');

        HTMLFormElement.prototype.submit.call(form);    });
});