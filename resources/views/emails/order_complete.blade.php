<h2>ご注文ありがとうございました。</h2>

<p>以下の内容で注文を承りました。</p>

<h3>◆配送先情報</h3>
<ul>
    <li>氏名: {{ $order->user->family_name }} {{ $order->user->first_name }}</li>
    <li>住所: {{ $order->postcode }} {{ $order->address }}</li>
    <li>電話番号: {{ $order->tel }}</li>
</ul>

<h3>◆ご注文商品</h3>
<ul>
@foreach ($order->orderItems as $item)
    <li>{{ $item->product->name }} / サイズ: {{ $item->size }} / 数量: {{ $item->quantity }} /金額: ￥{{ number_format($item->price * $item->quantity) }}</li>
@endforeach
</ul>

<p><strong>合計金額: ￥{{ number_format($order->total_price) }}</strong></p>
