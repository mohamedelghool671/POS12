<?php

return [



    'accepted' => 'يجب قبول :attribute.',
    'accepted_if' => 'يجب قبول :attribute عندما :other يساوي :value.',
    'active_url' => ':attribute ليس عنوان URL صحيح.',
    'after' => 'يجب أن يكون :attribute تاريخاً بعد :date.',
    'after_or_equal' => 'يجب أن يكون :attribute تاريخاً بعد أو يساوي :date.',
    'alpha' => 'يجب أن يحتوي :attribute على أحرف فقط.',
    'alpha_dash' => 'يجب أن يحتوي :attribute على أحرف وأرقام وشرطات فقط.',
    'alpha_num' => 'يجب أن يحتوي :attribute على أحرف وأرقام فقط.',
    'array' => 'يجب أن يكون :attribute مصفوفة.',
    'ascii' => 'يجب أن يحتوي :attribute على أحرف ASCII أحادية البايت فقط.',
    'before' => 'يجب أن يكون :attribute تاريخاً قبل :date.',
    'before_or_equal' => 'يجب أن يكون :attribute تاريخاً قبل أو يساوي :date.',
    'between' => [
        'array' => 'يجب أن يحتوي :attribute على :min إلى :max عنصر.',
        'file' => 'يجب أن يكون حجم :attribute بين :min و :max كيلوبايت.',
        'numeric' => 'يجب أن يكون :attribute بين :min و :max.',
        'string' => 'يجب أن يكون طول :attribute بين :min و :max حرف.',
    ],
    'boolean' => 'يجب أن يكون :attribute صحيح أو خطأ.',
    'can' => 'يحتوي :attribute على قيمة غير مصرح بها.',
    'confirmed' => 'تأكيد :attribute غير متطابق.',
    'current_password' => 'كلمة المرور غير صحيحة.',
    'date' => ':attribute ليس تاريخاً صحيح.',
    'date_equals' => 'يجب أن يكون :attribute تاريخاً يساوي :date.',
    'date_format' => 'لا يتطابق :attribute مع التنسيق :format.',
    'decimal' => 'يجب أن يحتوي :attribute على :decimal منازل عشرية.',
    'declined' => 'يجب رفض :attribute.',
    'declined_if' => 'يجب رفض :attribute عندما :other يساوي :value.',
    'different' => 'يجب أن يكون :attribute و :other مختلفين.',
    'digits' => 'يجب أن يكون :attribute :digits أرقام.',
    'digits_between' => 'يجب أن يكون :attribute بين :min و :max أرقام.',
    'dimensions' => 'أبعاد :attribute غير صحيحة.',
    'distinct' => 'يحتوي :attribute على قيمة مكررة.',
    'doesnt_end_with' => 'يجب ألا ينتهي :attribute بأحد: :values.',
    'doesnt_start_with' => 'يجب ألا يبدأ :attribute بأحد: :values.',
    'email' => 'يجب أن يكون :attribute عنوان بريد إلكتروني صحيح.',
    'ends_with' => 'يجب أن ينتهي :attribute بأحد: :values.',
    'enum' => 'القيمة المحددة :attribute غير صحيحة.',
    'exists' => 'القيمة المحددة :attribute غير موجودة.',
    'extensions' => 'يجب أن يحتوي :attribute على أحد الامتدادات: :values.',
    'file' => 'يجب أن يكون :attribute ملف.',
    'filled' => 'يجب ملء :attribute.',
    'gt' => [
        'array' => 'يجب أن يحتوي :attribute على أكثر من :value عنصر.',
        'file' => 'يجب أن يكون حجم :attribute أكبر من :value كيلوبايت.',
        'numeric' => 'يجب أن يكون :attribute أكبر من :value.',
        'string' => 'يجب أن يكون طول :attribute أكبر من :value حرف.',
    ],
    'gte' => [
        'array' => 'يجب أن يحتوي :attribute على :value عنصر أو أكثر.',
        'file' => 'يجب أن يكون حجم :attribute أكبر من أو يساوي :value كيلوبايت.',
        'numeric' => 'يجب أن يكون :attribute أكبر من أو يساوي :value.',
        'string' => 'يجب أن يكون طول :attribute أكبر من أو يساوي :value حرف.',
    ],
    'hex_color' => 'يجب أن يكون :attribute لون hex صحيح.',
    'image' => 'يجب أن يكون :attribute صورة.',
    'in' => 'القيمة المحددة :attribute غير صحيحة.',
    'in_array' => 'لا يوجد :attribute في :other.',
    'integer' => 'يجب أن يكون :attribute رقماً صحيحاً.',
    'ip' => 'يجب أن يكون :attribute عنوان IP صحيح.',
    'ipv4' => 'يجب أن يكون :attribute عنوان IPv4 صحيح.',
    'ipv6' => 'يجب أن يكون :attribute عنوان IPv6 صحيح.',
    'json' => 'يجب أن يكون :attribute نص JSON صحيح.',
    'lowercase' => 'يجب أن يكون :attribute بأحرف صغيرة.',
    'lt' => [
        'array' => 'يجب أن يحتوي :attribute على أقل من :value عنصر.',
        'file' => 'يجب أن يكون حجم :attribute أقل من :value كيلوبايت.',
        'numeric' => 'يجب أن يكون :attribute أقل من :value.',
        'string' => 'يجب أن يكون طول :attribute أقل من :value حرف.',
    ],
    'lte' => [
        'array' => 'يجب ألا يحتوي :attribute على أكثر من :value عنصر.',
        'file' => 'يجب أن يكون حجم :attribute أقل من أو يساوي :value كيلوبايت.',
        'numeric' => 'يجب أن يكون :attribute أقل من أو يساوي :value.',
        'string' => 'يجب أن يكون طول :attribute أقل من أو يساوي :value حرف.',
    ],
    'mac_address' => 'يجب أن يكون :attribute عنوان MAC صحيح.',
    'max' => [
        'array' => 'يجب ألا يحتوي :attribute على أكثر من :max عنصر.',
        'file' => 'يجب ألا يكون حجم :attribute أكبر من :max كيلوبايت.',
        'numeric' => 'يجب ألا يكون :attribute أكبر من :max.',
        'string' => 'يجب ألا يكون طول :attribute أكبر من :max حرف.',
    ],
    'max_digits' => 'يجب ألا يحتوي :attribute على أكثر من :max أرقام.',
    'mimes' => 'يجب أن يكون :attribute ملف من نوع: :values.',
    'mimetypes' => 'يجب أن يكون :attribute ملف من نوع: :values.',
    'min' => [
        'array' => 'يجب أن يحتوي :attribute على :min عنصر على الأقل.',
        'file' => 'يجب أن يكون حجم :attribute :min كيلوبايت على الأقل.',
        'numeric' => 'يجب أن يكون :attribute :min على الأقل.',
        'string' => 'يجب أن يكون طول :attribute :min حرف على الأقل.',
    ],
    'min_digits' => 'يجب أن يحتوي :attribute على :min أرقام على الأقل.',
    'missing' => 'يجب أن يكون :attribute مفقود.',
    'missing_if' => 'يجب أن يكون :attribute مفقود عندما :other يساوي :value.',
    'missing_unless' => 'يجب أن يكون :attribute مفقود ما لم يكن :other يساوي :value.',
    'missing_with' => 'يجب أن يكون :attribute مفقود عندما :values موجود.',
    'missing_with_all' => 'يجب أن يكون :attribute مفقود عندما :values موجودة.',
    'multiple_of' => 'يجب أن يكون :attribute مضاعف :value.',
    'not_in' => 'القيمة المحددة :attribute غير صحيحة.',
    'not_regex' => 'تنسيق :attribute غير صحيح.',
    'numeric' => 'يجب أن يكون :attribute رقماً.',
    'password' => [
        'letters' => 'يجب أن يحتوي :attribute على حرف واحد على الأقل.',
        'mixed' => 'يجب أن يحتوي :attribute على حرف كبير وحرف صغير على الأقل.',
        'numbers' => 'يجب أن يحتوي :attribute على رقم واحد على الأقل.',
        'symbols' => 'يجب أن يحتوي :attribute على رمز واحد على الأقل.',
        'uncompromised' => 'يبدو أن :attribute المحدد قد ظهر في تسريب للبيانات. يرجى اختيار :attribute مختلف.',
    ],
    'present' => 'يجب أن يكون :attribute موجود.',
    'present_if' => 'يجب أن يكون :attribute موجود عندما :other يساوي :value.',
    'present_unless' => 'يجب أن يكون :attribute موجود ما لم يكن :other يساوي :value.',
    'present_with' => 'يجب أن يكون :attribute موجود عندما :values موجود.',
    'present_with_all' => 'يجب أن يكون :attribute موجود عندما :values موجودة.',
    'prohibited' => 'الحقل :attribute محظور.',
    'prohibited_if' => 'الحقل :attribute محظور عندما :other يساوي :value.',
    'prohibited_unless' => 'الحقل :attribute محظور ما لم يكن :other في :values.',
    'prohibits' => 'الحقل :attribute يمنع :other من الوجود.',
    'regex' => 'تنسيق :attribute غير صحيح.',
    'required' => 'الحقل :attribute مطلوب.',
    'required_array_keys' => 'الحقل :attribute يجب أن يحتوي على إدخالات لـ: :values.',
    'required_if' => 'الحقل :attribute مطلوب عندما :other يساوي :value.',
    'required_if_accepted' => 'الحقل :attribute مطلوب عندما :other مقبول.',
    'required_unless' => 'الحقل :attribute مطلوب ما لم يكن :other في :values.',
    'required_with' => 'الحقل :attribute مطلوب عندما :values موجود.',
    'required_with_all' => 'الحقل :attribute مطلوب عندما :values موجودة.',
    'required_without' => 'الحقل :attribute مطلوب عندما :values غير موجود.',
    'required_without_all' => 'الحقل :attribute مطلوب عندما لا توجد أي من :values.',
    'same' => 'يجب أن يكون :attribute و :other متطابقين.',
    'size' => [
        'array' => 'يجب أن يحتوي :attribute على :size عنصر.',
        'file' => 'يجب أن يكون حجم :attribute :size كيلوبايت.',
        'numeric' => 'يجب أن يكون :attribute :size.',
        'string' => 'يجب أن يكون طول :attribute :size حرف.',
    ],
    'starts_with' => 'يجب أن يبدأ :attribute بأحد: :values.',
    'string' => 'يجب أن يكون :attribute نص.',
    'timezone' => 'يجب أن يكون :attribute منطقة زمنية صحيحة.',
    'unique' => 'هذا :attribute مستخدم بالفعل.',
    'uploaded' => 'فشل في رفع :attribute.',
    'uppercase' => 'يجب أن يكون :attribute بأحرف كبيرة.',
    'url' => 'تنسيق :attribute غير صحيح.',
    'ulid' => 'يجب أن يكون :attribute ULID صحيح.',
    'uuid' => 'يجب أن يكون :attribute UUID صحيح.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "rule.attribute" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'رسالة مخصصة',
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
        'name' => 'الاسم',
        'email' => 'البريد الإلكتروني',
        'password' => 'كلمة المرور',
        'password_confirmation' => 'تأكيد كلمة المرور',
        'phone' => 'رقم الهاتف',
        'address' => 'العنوان',
        'image' => 'الصورة',
        'category_name' => 'اسم الفئة',
        'price' => 'السعر',
        'purchase_price' => 'سعر الشراء',
        'count' => 'العدد',
        'description' => 'الوصف',
        'payment_type' => 'نوع الدفع',
        'card_number' => 'رقم البطاقة',
        'cardholder_name' => 'اسم حامل البطاقة',
        'order_id' => 'معرف الطلب',
        'order_status' => 'حالة الطلب',
        'order_code' => 'كود الطلب',
        'reject_reason' => 'سبب الرفض',
        'old_password' => 'كلمة المرور القديمة',
        'new_password' => 'كلمة المرور الجديدة',
        'confirm_password' => 'تأكيد كلمة المرور',
        'subject' => 'الموضوع',
        'message' => 'الرسالة',
        'pay_slip_image' => 'صورة إيصال الدفع',
        'payment_method' => 'طريقة الدفع',
        'total_amount' => 'المبلغ الإجمالي',
    ],

];
