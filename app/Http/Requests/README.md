# Request Classes Documentation

## نظرة عامة
تم إنشاء Request Classes منفصلة للفاليديشن في مجلدات Admin و User لتحسين تنظيم الكود وجعل رسائل الفاليديشن متعددة اللغات.

## Request Classes للأدمن

### Product Requests
- `StoreProductRequest`: للفاليديشن عند إنشاء منتج جديد
- `UpdateProductRequest`: للفاليديشن عند تحديث منتج موجود

### Category Requests
- `StoreCategoryRequest`: للفاليديشن عند إنشاء فئة جديدة
- `UpdateCategoryRequest`: للفاليديشن عند تحديث فئة موجودة

### Profile Requests
- `StoreAdminRequest`: للفاليديشن عند إنشاء حساب أدمن جديد
- `UpdateProfileRequest`: للفاليديشن عند تحديث الملف الشخصي

### Payment Requests
- `StorePaymentRequest`: للفاليديشن عند إنشاء وسيلة دفع جديدة
- `UpdatePaymentRequest`: للفاليديشن عند تحديث وسيلة دفع موجودة

### Order Requests
- `UpdateOrderStatusRequest`: للفاليديشن عند تحديث حالة الطلب
- `RejectOrderRequest`: للفاليديشن عند رفض الطلب

### Auth Requests
- `ChangePasswordRequest`: للفاليديشن عند تغيير كلمة المرور
- `ResetPasswordRequest`: للفاليديشن عند إعادة تعيين كلمة المرور

## Request Classes للمستخدمين

### Comment Requests
- `CommentRequest`: للفاليديشن عند إضافة تعليق

### Profile Requests
- `UpdateUserProfileRequest`: للفاليديشن عند تحديث ملف المستخدم الشخصي
- `ChangeUserPasswordRequest`: للفاليديشن عند تغيير كلمة مرور المستخدم

### Message Requests
- `SendMessageRequest`: للفاليديشن عند إرسال رسالة

## المميزات

### 1. رسائل متعددة اللغات
جميع رسائل الفاليديشن تستخدم دوال الترجمة `__('messages.key')` مما يجعلها متوافقة مع نظام الترجمة العربي/الإنجليزي.

### 2. تنظيم أفضل للكود
- فصل منطق الفاليديشن عن الكنترولرات
- سهولة الصيانة والتطوير
- إمكانية إعادة الاستخدام

### 3. أمان محسن
- فاليديشن تلقائي قبل الوصول للكنترولر
- رسائل خطأ واضحة ومترجمة

## كيفية الاستخدام

### في الكنترولر
```php
use App\Http\Requests\Admin\StoreProductRequest;

public function store(StoreProductRequest $request)
{
    // الكود هنا يعمل فقط إذا مر الفاليديشن
    $this->productService->createProductFromRequest($request);
    return redirect()->route('product.index');
}
```

### إضافة Request Class جديد
1. أنشئ ملف جديد في المجلد المناسب
2. اتبع النمط الموجود في الملفات الأخرى
3. أضف مفاتيح الترجمة في ملفات `messages.php`
4. استخدم الـ Request Class في الكنترولر

## رسائل الفاليديشن المضافة

### المنتجات
- `product_name_required`
- `product_name_unique`
- `product_price_required`
- `product_price_numeric`
- `product_purchase_price_required`
- `product_purchase_price_numeric`
- `product_category_required`
- `product_category_exists`
- `product_count_required`
- `product_count_integer`
- `product_count_max`
- `product_description_required`
- `product_image_required`
- `product_image_mimes`

### الفئات
- `category_name_required`
- `category_name_unique`

### الملف الشخصي
- `profile_name_required`
- `profile_email_required`
- `profile_email_unique`
- `profile_phone_required`
- `profile_phone_unique`
- `profile_address_required`

### حسابات الأدمن
- `admin_name_required`
- `admin_email_required`
- `admin_email_valid`
- `admin_email_unique`
- `admin_password_required`
- `admin_password_min`
- `admin_confirm_password_required`
- `admin_confirm_password_same`

### التعليقات
- `comment_message_required`

### وسائل الدفع
- `payment_type_required`
- `payment_card_number_required`
- `payment_cardholder_name_required`

### الطلبات
- `order_id_required`
- `order_status_required`
- `order_status_invalid`
- `order_code_required`
- `reject_reason_required`

### كلمات المرور
- `old_password_required`
- `new_password_required`
- `confirm_password_required`
- `confirm_password_same`
- `email_required`
- `email_valid`
- `email_not_found`

### المستخدمين
- `user_phone_required`
- `user_phone_unique`
- `user_address_required`
- `user_image_mimes`
- `user_old_password_required`
- `user_new_password_required`
- `user_confirm_password_required`
- `user_confirm_password_same`

### الرسائل
- `message_subject_required`
- `message_content_required` 
