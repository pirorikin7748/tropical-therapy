<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    "accepted" => ":Attributeを承認してください。",
    "accepted_if" => ":Otherが:valueの場合、:attributeを承認する必要があります。",
    "active_url" => ":Attributeは、有効なURLではありません。",
    "after" => ":Attributeには、:dateより後の日付を指定してください。",
    "after_or_equal" => ":Attributeには、:date以降の日付を指定してください。",
    "alpha" => ":Attributeには、アルファベッドのみ使用できます。",
    "alpha_dash" => ":Attributeには、英数字('A-Z','a-z','0-9')とハイフンと下線('-','_')が使用できます。",
    "alpha_num" => ":Attributeには、英数字('A-Z','a-z','0-9')が使用できます。",
    "any_of" => "The :attribute field is invalid.",
    "array" => ":Attributeには、配列を指定してください。",
    "ascii" => ":Attributeには、英数字と記号のみ使用可能です。",
    "attached" => "この:attributeはすでに添付されています。",
    "before" => ":Attributeには、:dateより前の日付を指定してください。",
    "before_or_equal" => ":Attributeには、:date以前の日付を指定してください。",
    "between.array" => ":Attributeの項目は、:min個から:max個にしてください。",
    "between.file" => ":Attributeには、:min KBから:max KBまでのサイズのファイルを指定してください。",
    "between.numeric" => ":Attributeには、:minから、:maxまでの数字を指定してください。",
    "between.string" => ":Attributeは、:min文字から:max文字にしてください。",
    "boolean" => ":Attributeには、'true'か'false'を指定してください。",
    "can" => ":Attributeに権限のない値が含まれています。",
    "confirmed" => ":Attributeと:attribute確認が一致しません。",
    "contains" => ":Attributeに必須項目が含まれていません。",
    "current_password" => "パスワードが正しくありません。",
    "date" => ":Attributeは、正しい日付ではありません。",
    "date_equals" => ":Attributeは:dateと同じ日付を入力してください。",
    "date_format" => ":Attributeの形式が':format'と一致しません。",
    "decimal" => ":Attributeは、小数点以下が:decimalである必要があります。",
    "declined" => ":Attributeを拒否する必要があります。",
    "declined_if" => ":Otherが:valueの場合、:attributeを拒否する必要があります。",
    "different" => ":Attributeと:otherには、異なるものを指定してください。",
    "digits" => ":Attributeは、:digits桁にしてください。",
    "digits_between" => ":Attributeは、:min桁から:max桁にしてください。",
    "dimensions" => ":Attributeの画像サイズが無効です",
    "distinct" => ":Attributeの値が重複しています。",
    "doesnt_end_with" => ":Attributeの終わりは「:values」以外である必要があります。",
    "doesnt_start_with" => ":Attributeの始まりは「:values」以外である必要があります。",
    "email" => ":Attributeは、有効なメールアドレス形式で指定してください。",
    "ends_with" => ":Attributeの終わりは「:values」である必要があります。",
    "enum" => "選択した :attributeは 無効です。",
    "exists" => "選択された:attributeは、有効ではありません。",
    "extensions" => ":attribute には、次のいずれかの拡張子が必要です: :values",
    "failed" => "認証に失敗しました。",
    "file" => ":Attributeには、ファイル形式を指定してください。",
    "filled" => ":Attributeは必須です。",
    "gt.array" => ":Attributeの項目数は、:value個より多い必要があります。",
    "gt.file" => ":Attributeは、:value KBより大きい必要があります。",
    "gt.numeric" => ":Attributeは、:valueより大きい必要があります。",
    "gt.string" => ":Attributeは、:value文字を超える必要があります。",
    "gte.array" => ":Attributeの項目数は、:value個以上である必要があります。",
    "gte.file" => ":Attributeは、:value KB以上である必要があります。",
    "gte.numeric" => ":Attributeは、:value以上である必要があります。",
    "gte.string" => ":Attributeは、:value文字以上である必要があります。",
    "hex_color" => ":attributeは、有効な16進数カラーコードを指定してください。",
    "image" => ":Attributeには、画像を指定してください。",
    "in" => "選択された:attributeは、有効ではありません。",
    "in_array" => ":Attributeが:otherに存在しません。",
    "integer" => ":Attributeには、整数を指定してください。",
    "ip" => ":Attributeには、有効なIPアドレスを指定してください。",
    "ipv4" => ":AttributeはIPv4アドレスを指定してください。",
    "ipv6" => ":AttributeはIPv6アドレスを指定してください。",
    "json" => ":Attributeには、有効なJSON文字列を指定してください。",
    "list" => ":attribute フィールドはリストでなければなりません。",
    "lowercase" => ":Attributeは、小文字で入力してください。",
    "lt.array" => ":Attributeの項目数は、:value個より少ない必要があります。",
    "lt.file" => ":Attributeは、:value KBより小さい必要があります。",
    "lt.numeric" => ":Attributeは、:valueより小さい必要があります。",
    "lt.string" => ":Attributeは、:value文字より小さい必要があります。",
    "lte.array" => ":Attributeの項目数は、:value個以下である必要があります。",
    "lte.file" => ":Attributeは、:value KB以下である必要があります。",
    "lte.numeric" => ":Attributeは、:value以下である必要があります。",
    "lte.string" => ":Attributeは、:value文字以下である必要があります。",
    "mac_address" => ":Attributeは有効なMACアドレスである必要があります。",
    "max.array" => ":Attributeの項目数は、:max個以下である必要があります。",
    "max.file" => ":Attributeは、:max KB以下のファイルである必要があります。",
    "max.numeric" => ":Attributeは、:max以下の数値である必要があります。",
    "max.string" => ":Attributeの文字数は、:max文字以下である必要があります。",
    "max_digits" => ":Attributeは、:max桁以下の数字である必要があります。",
    "mimes" => ":Attributeには、以下のファイルタイプを指定してください。:values",
    "mimetypes" => ":Attributeには、以下のファイルタイプを指定してください。:values",
    "min.array" => ":Attributeの項目数は、:min個以上にしてください。",
    "min.file" => ":Attributeには、:min KB以上のファイルを指定してください。",
    "min.numeric" => ":Attributeには、:min以上の数値を指定してください。",
    "min.string" => ":Attributeの文字数は、:min文字以上である必要があります。",
    "min_digits" => ":Attributeは、:min桁以上の数字である必要があります。",
    "missing" => ":Attribute を入力する必要はありません。",
    "missing_if" => ":Other が :value の場合、:attribute を入力する必要はありません。",
    "missing_unless" => ":Other が :value でない限り、:attribute をは入力する必要はありません。",
    "missing_with" => ":Values が存在する場合、:attribute をは入力する必要はありません。",
    "missing_with_all" => ":Values が存在する場合、:attribute をは入力する必要はありません。",
    "multiple_of" => ":Attributeは:valueの倍数である必要があります",
    "next" => "次へ &raquo;",
    "not_in" => "選択された:attributeは、有効ではありません。",
    "not_regex" => ":Attributeの形式が正しくありません。",
    "numeric" => ":Attributeには、数値を指定してください。",
    "password" => "パスワードが正しくありません。",
    "password.letters" => ":Attributeは文字を1文字以上含める必要があります。",
    "password.mixed" => ":Attributeは大文字と小文字をそれぞれ1文字以上含める必要があります。",
    "password.numbers" => ":Attributeは数字を1文字以上含める必要があります。",
    "password.symbols" => ":Attributeは記号を1文字以上含める必要があります。",
    "password.uncompromised" => ":Attributeは情報漏洩した可能性があります。他の:attributeを選択してください。",
    "present" => ":Attributeが存在している必要があります。",
    "present_if" => ":other が :value の場合、:Attributeが存在する必要があります。",
    "present_unless" => ":other が :value でない限り、:Attributeが存在する必要があります。",
    "present_with" => ":values が存在する場合は、:Attributeも存在する必要があります。",
    "present_with_all" => ":values が存在する場合は、:Attributeが存在する必要があります。",
    "previous" => "&laquo; 前へ",
    "prohibited" => ":Attributeの入力は禁止されています。",
    "prohibited_if" => ":Otherが:valueの場合は、:Attributeの入力が禁止されています。",
    "prohibited_if_accepted" => ":Otherが承認された場合、この項目の入力は禁止されています。",
    "prohibited_if_declined" => ":Otherが拒否された場合、この項目の入力は禁止されています。",
    "prohibited_unless" => ":Otherが:valuesでない限り、:Attributeの入力は禁止されています。",
    "prohibits" => ":Otherが存在している場合、:Attributeの入力は禁止されています。",
    "regex" => ":Attributeには、正しい形式を指定してください。",
    "relatable" => ":Attributeはこのリソースとの関連がありません。",
    "required" => ":Attributeは必須項目です。",
    "required_array_keys" => ":Attributeには、:valuesのエントリを含める必要があります。",
    "required_if" => ":Otherが:valueの場合、:attributeを指定してください。",
    "required_if_accepted" => ":Otherを承認した場合、:attributeは必須項目です。",
    "required_if_declined" => ":Otherを拒否した場合、:attributeは必須項目です。",
    "required_unless" => ":Otherが:values以外の場合、:attributeは必須項目です。",
    "required_with" => ":Valuesが入力されている場合、:attributeは必須項目です。",
    "required_with_all" => ":Valuesが全て指定されている場合、:attributeは必須項目です。",
    "required_without" => ":Valuesが入力されていない場合、:attributeは必須項目です。",
    "required_without_all" => ":Valuesが全て指定されていない場合、:attributeを指定してください。",
    "reset" => "パスワードが再設定されました。",
    "same" => ":Attributeと:otherが一致しません。",
    "sent" => "パスワードリセットメールを送信しました。",
    "size.array" => ":Attributeの項目数は、:size個にしてください。",
    "size.file" => ":Attributeには、:size KBのファイルを指定してください。",
    "size.numeric" => ":Attributeには、:sizeを指定してください。",
    "size.string" => ":Attributeの文字数は、:size文字にしてください。",
    "starts_with" => ":Attributeは、次のいずれかで始まる必要があります。:values",
    "string" => ":Attributeには、文字列を指定してください。",
    "throttle" => "ログインの試行回数が多すぎます。:seconds 秒後にお試しください。",
    "throttled" => "時間を置いて再度お試しください。",
    "timezone" => ":Attributeには、有効なタイムゾーンを指定してください。",
    "token" => "このパスワード再設定トークンは無効です。",
    "ulid" => ":Attributeは、有効なULIDである必要があります。",
    "unique" => "指定の:attributeは既に使用されています。",
    "uploaded" => ":Attributeのアップロードに失敗しました。",
    "uppercase" => ":Attributeは、大文字で入力してください。",
    "url" => ":Attributeは、有効なURL形式で指定してください。",
    "user" => "このメールアドレスに一致するユーザーがいません。",
    "uuid" => ":Attributeは、有効なUUIDである必要があります。",
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'password' => 'パスワード'
    ],

];
