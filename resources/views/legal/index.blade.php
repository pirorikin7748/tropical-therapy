<x-app-layout>
    <x-slot name="title">会社概要・ポリシー</x-slot>

    @vite(['resources/css/legal.css'])

    <div class="max-w-3xl mx-auto px-4 py-12 bg-white shadow-sm rounded legal-page">
    <h2 class="text-2xl font-bold text-teal-800 mb-6 text-center">会社概要・ポリシー</h2>
        <hr class="mb-6">

        <!-- 会社概要 -->
        <section id="about" class="mb-12">
            <h3 class="text-xl font-bold text-green-700 mb-2">会社概要</h3>
            <p><strong>会社名：</strong>TROPICALTHERAPY（トロピカルセラピー）</p>
            <p><strong>所在地：</strong>〒261-0004 千葉県千葉市美浜区〇〇〇〇</p>
            <p><strong>設立：</strong>2025年4月</p>
            <p><strong>代表者：</strong>砂永 大志</p>
            <p><strong>事業内容：</strong></p>
            <ul class="list-disc pl-6">
                <li>ファッションアイテムの企画・販売</li>
                <li>オンラインストア「TROPICALTHERAPY」の運営</li>
                <li>サステナブル素材の研究・開発</li>
            </ul>
            <p class="mt-4">「心も身体も癒されるようなファッション」をテーマに、南国の自然からインスピレーションを得たアイテムを提供しています。</p>
        </section>

        <!-- プライバシーポリシー -->
        <section id="privacy" class="mb-12">
            <h3 class="text-xl font-bold text-green-700 mb-2">プライバシーポリシー</h3>
            <p class="mb-4">TROPICALTHERAPY（以下、「当店」といいます）は、お客様の個人情報を適切に取り扱い、保護することを重要な責務と考えています。</p>

            <h4 class="font-bold">1. 個人情報の定義</h4>
            <p>氏名、住所、電話番号、メールアドレスなど、特定の個人を識別できる情報を指します。</p>

            <h4 class="font-bold mt-4">2. 利用目的</h4>
            <p>商品の発送、カスタマーサポート、メールマガジンの配信などに利用します。</p>

            <h4 class="font-bold mt-4">3. 第三者提供の制限</h4>
            <p>法令に基づく場合を除き、本人の同意なく第三者に提供することはありません。</p>

            <h4 class="font-bold mt-4">4. 安全管理措置</h4>
            <p>個人情報の漏洩、紛失、改ざんを防ぐため、適切なセキュリティ対策を実施します。</p>

            <h4 class="font-bold mt-4">5. お問い合わせ窓口</h4>
            <p>個人情報に関するお問い合わせは、お問い合わせフォームよりご連絡ください。</p>
        </section>

        <!-- 利用規約 -->
        <section id="terms">
            <h3 class="text-xl font-bold text-green-700 mb-2">利用規約</h3>

            <h4 class="font-bold">第1条（適用）</h4>
            <p>本規約は、当店とユーザーとのすべての関係に適用されます。</p>

            <h4 class="font-bold mt-4">第2条（禁止事項）</h4>
            <ul class="list-disc pl-6">
                <li>他のお客様、第三者、または当店に損害を与える行為</li>
                <li>法令または公序良俗に反する行為</li>
                <li>虚偽の情報提供やなりすまし</li>
            </ul>

            <h4 class="font-bold mt-4">第3条（サービスの停止）</h4>
            <p>当店は、メンテナンスやシステム障害などによりサービスを一時停止する場合があります。</p>

            <h4 class="font-bold mt-4">第4条（免責事項）</h4>
            <p>提供する情報やサービスの完全性・正確性について、当店は保証いたしません。</p>

            <h4 class="font-bold mt-4">第5条（著作権）</h4>
            <p>当サイトの画像・文章・デザイン等の著作権は、当店または正当な権利者に帰属します。</p>
        </section>
    </div>
</x-app-layout>