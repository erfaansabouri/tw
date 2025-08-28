<?php

namespace Database\Seeders;

use App\Models\ExerciseAnswer;
use App\Models\ExerciseQuestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExerciseQuestionSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run () {
        ExerciseQuestion::truncate();
        ExerciseAnswer::truncate();
        $this->one();
        $this->two();
        $this->three();
        $this->four();
        $this->five();
        $this->six();
        $this->seven();
        $this->eight();
        $this->nine();
        $this->ten();
        $this->eleven();
        $this->twelve();
        $this->thirteen();
        $this->fourteen();
        $this->fifteen();
        $this->sixteen();
        $this->seventeen();
        $this->eighteen();
        $this->nineteen();
        $this->twenty();
        $this->twentyOne();
    }

    public function one () {
        ExerciseQuestion::query()
                        ->create([
                                     'sort' => 1 ,
                                     'day_id' => 1 ,
                                     'type' => ExerciseQuestion::TYPES[ 'SIMPLE_DESCRIPTION' ] ,
                                     'question' => ([
                                                                   'description' => 'بعد از انتخاب عادت، پیش نیاز ها رو در نظر بگیر! مثلا اگه انتخاب کردی که از ورزش یه عادت بســازی، قبلش لازم داری مطمئن بشــی توی طول روز مواد غذایی به اندازه کافی مصـرف میکنی و انرژیت قرار نیسـت ته بکشـه! چون سـاختن یه عادت جدید بدون داشتن انرژی کافی کار خیلی سختیه و احتمالا وسط کار میذاریش کنار! پس پیش نیاز های عادتت رو شناسایی کن و همین ابتدای کار شروع کن به برآورده کردنشون.' ,
                                                               ]) ,
                                 ]);
        ExerciseQuestion::query()
                        ->create([
                                     'sort' => 2 ,
                                     'day_id' => 1 ,
                                     'type' => ExerciseQuestion::TYPES[ 'ORDERED_LIST' ] ,
                                     'question' => ([
                                                                   'description' => 'پیش نیاز های عادت جدیدم' ,
                                                               ]) ,
                                 ]);
        ExerciseQuestion::query()
                        ->create([
                                     'sort' => 3 ,
                                     'day_id' => 1 ,
                                     'type' => ExerciseQuestion::TYPES[ 'SIMPLE_DESCRIPTION' ] ,
                                     'question' => ([
                                                                   'description' => 'علاوه بر اهمیت شــناســایی پیش نیاز های عادتت و برآورده کردن اونها، لازم داری بدونی اگر قرار هسـت عادتی رو ایجاد کنی، باید شـخصـیت و هویتی رو توی خودت ببینی که اون عادت رو داره! اگه میخوای از ورزش یه عادت بسـازی، باید توی شـخصـیتت اهمیت دادن به سـلامتی رو داشـته ببینی، اگه میخوای آدمی باشـی که هر روز کتاب میخونه، باید باور داشـته باشـی کسـی هسـتی
که وقتش رو هدر نمیده و برای یادگیری ارزش قائله.
' ,
                                                               ]) ,
                                 ]);
        ExerciseQuestion::query()
                        ->create([
                                     'sort' => 4 ,
                                     'day_id' => 1 ,
                                     'type' => ExerciseQuestion::TYPES[ 'ORDERED_LIST' ] ,
                                     'question' => ([
                                                                   'description' => 'شخصیت الگوی من
این اخلاقیت رو داره' ,
                                                               ]) ,
                                 ]);
    }

    public function two () {
        ExerciseQuestion::query()
                        ->create([
                                     'sort' => 1 ,
                                     'day_id' => 2 ,
                                     'type' => ExerciseQuestion::TYPES[ 'PERCENTAGE' ] ,
                                     'question' => ([
                                                                   'description' => 'درجه سختی اجرای عادت جدید' ,
                                                               ]) ,
                                 ]);
        ExerciseQuestion::query()
                        ->create([
                                     'sort' => 2 ,
                                     'day_id' => 2 ,
                                     'type' => ExerciseQuestion::TYPES[ 'PERCENTAGE' ] ,
                                     'question' => ([
                                                                   'description' => 'درجه احساس رضایت از تصمیمم' ,
                                                               ]) ,
                                 ]);
        ExerciseQuestion::query()
                        ->create([
                                     'sort' => 3 ,
                                     'day_id' => 2 ,
                                     'type' => ExerciseQuestion::TYPES[ 'SIMPLE_DESCRIPTION' ] ,
                                     'question' => ([
                                                                   'description' => 'قدم مهم امروز… همین اول مسیر، کارایی که از پروسه متنفرت میکنن رو شناسایی کن و بذارشون کنار.' ,
                                                               ]) ,
                                 ]);
        ExerciseQuestion::query()
                        ->create([
                                     'sort' => 4 ,
                                     'day_id' => 2 ,
                                     'type' => ExerciseQuestion::TYPES[ 'ORDERED_LIST' ] ,
                                     'question' => ([
                                                                   'description' => 'کارایی که من رو از
پروسه متنفر می‌کنن؛' ,
                                                               ]) ,
                                 ]);
        ExerciseQuestion::query()
                        ->create([
                                     'sort' => 5 ,
                                     'day_id' => 2 ,
                                     'type' => ExerciseQuestion::TYPES[ 'ORDERED_LIST' ] ,
                                     'question' => ([
                                                                   'description' => 'جایگزین اون کارها
(اگه دارن  اینجا بنویس)' ,
                                                               ]) ,
                                 ]);
        ExerciseQuestion::query()
                        ->create([
                                     'sort' => 6 ,
                                     'day_id' => 2 ,
                                     'type' => ExerciseQuestion::TYPES[ 'NOTE' ] ,
                                     'question' => ([
                                                                   'description' => 'جمله ای که امروز لازمش دارم؛' ,
                                                               ]) ,
                                 ]);
    }

    public function three () {
        ExerciseQuestion::query()
                        ->create([
                                     'sort' => 1 ,
                                     'day_id' => 3 ,
                                     'type' => ExerciseQuestion::TYPES[ 'SIMPLE_DESCRIPTION' ] ,
                                     'question' => ([
                                                                   'description' => 'فانتزی های من برای عادت جدیدم؛ ' ,
                                                               ]) ,
                                 ]);
        ExerciseQuestion::query()
                        ->create([
                                     'sort' => 2 ,
                                     'day_id' => 3 ,
                                     'type' => ExerciseQuestion::TYPES[ 'ORDERED_LIST' ] ,
                                     'question' => ([
                                                                   'description' => 'من میخوام بعد از نتیجه گرفتن از
عادت (فلان) این کار ها رو انجام بدم ' ,
                                                               ]) ,
                                 ]);
        ExerciseQuestion::query()
                        ->create([
                                     'sort' => 3 ,
                                     'day_id' => 3 ,
                                     'type' => ExerciseQuestion::TYPES[ 'NOTE' ] ,
                                     'question' => ([
                                                                   'description' => 'انتظاراتم از خودم برای فردا؛' ,
                                                               ]) ,
                                 ]);
    }

    public function four () {
        ExerciseQuestion::query()
                        ->create([
                                     'sort' => 1 ,
                                     'day_id' => 4 ,
                                     'type' => ExerciseQuestion::TYPES[ 'SIMPLE_DESCRIPTION' ] ,
                                     'question' => ([
                                                                   'description' => 'روتین خواب من؛' ,
                                                               ]) ,
                                 ]);
        ExerciseQuestion::query()
                        ->create([
                                     'sort' => 2 ,
                                     'day_id' => 4 ,
                                     'type' => ExerciseQuestion::TYPES[ 'FILL_IN_THE_BLANK' ] ,
                                     'question' => ([
                                                                   'description' => 'ساعت خواب [_] ساعت بیدار شدن [_]' ,
                                                               ]) ,
                                 ]);
        ExerciseQuestion::query()
                        ->create([
                                     'sort' => 3 ,
                                     'day_id' => 4 ,
                                     'type' => ExerciseQuestion::TYPES[ 'ORDERED_LIST' ] ,
                                     'question' => ([
                                                                   'description' => 'اقداماتی که می‌تونم برای تنظیم
روتین خوابم انجام بدم' ,
                                                               ]) ,
                                 ]);
        ExerciseQuestion::query()
                        ->create([
                                     'sort' => 3 ,
                                     'day_id' => 4 ,
                                     'type' => ExerciseQuestion::TYPES[ 'NOTE' ] ,
                                     'question' => ([
                                                                   'description' => 'چیزی که لازمه امروز
به خودم یادآوری کنم؛' ,
                                                               ]) ,
                                 ]);
    }

    public function five () {
        ExerciseQuestion::query()
                        ->create([
                                     'sort' => 1 ,
                                     'day_id' => 5 ,
                                     'type' => ExerciseQuestion::TYPES[ 'NOTE' ] ,
                                     'question' => ([
                                                                   'description' => 'نسخه ۲ دقیقه و ساده شده عادتم: ' ,
                                                               ]) ,
                                 ]);
        ExerciseQuestion::query()
                        ->create([
                                     'sort' => 2 ,
                                     'day_id' => 5 ,
                                     'type' => ExerciseQuestion::TYPES[ 'ORDERED_LIST' ] ,
                                     'question' => ([
                                                                   'description' => 'بهونه هایی که تا اینجای کار
ذهنم جلوی راهم گذاشته؛ ' ,
                                                               ]) ,
                                 ]);
        ExerciseQuestion::query()
                        ->create([
                                     'sort' => 3 ,
                                     'day_id' => 5 ,
                                     'type' => ExerciseQuestion::TYPES[ 'PERCENTAGE' ] ,
                                     'question' => ([
                                                                   'description' => 'میزان افت انگیزه تا اینجای کار' ,
                                                               ]) ,
                                 ]);
        ExerciseQuestion::query()
                        ->create([
                                     'sort' => 4 ,
                                     'day_id' => 5 ,
                                     'type' => ExerciseQuestion::TYPES[ 'ORDERED_LIST' ] ,
                                     'question' => ([
                                                                   'description' => 'اقدامی هست که بتونم برای
 بالا بردن انگیزهم انجام بدم؟
' ,
                                                               ]) ,
                                 ]);
    }

    public function six () {
        $sort = 1;
        $day = 6;
        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'SIMPLE_DESCRIPTION' ] ,
                                     'question' => ([
                                                                   'description' => 'ساختن قصد اجرایی عادت جدیدم' ,
                                                               ]) ,
                                 ]);
        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'FILL_IN_THE_BLANK' ] ,
                                     'question' => ([
                                                                   'description' => 'من در [_] (زمان) در [_] (مکان)
[_] (رفتار) رو انجام خواهم داد.' ,
                                                               ]) ,
                                 ]);
        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'NOTE' ] ,
                                     'question' => ([
                                                                   'description' => 'یادآوری امروز؛' ,
                                                               ]) ,
                                 ]);
    }

    public function seven(){
        $sort = 1;
        $day = 7;
        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'SIMPLE_DESCRIPTION' ] ,
                                     'question' => ([
                                                                   'description' => 'گره زدن عادت جدید با عادت قدیمی:' ,
                                                               ]) ,
                                 ]);
        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'FILL_IN_THE_BLANK' ] ,
                                     'question' => ([
                                                                   'description' => 'من فقط وقتی [_] (عادت و رفتار مورد علاقه) که [_] (عادتی که سعی در ایجادش را دارید) رو انجام بدم.' ,
                                                               ]) ,
                                 ]);
    }

    public function eight(){
        $sort = 1;
        $day = 8;
        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'SIMPLE_DESCRIPTION' ] ,
                                     'question' => ([
                                                                   'description' => 'توی این جدول یادآور هایی که لازم هسـت تعبیه بشـن رو لیسـت کردیم و لازمـه کـه حـداقـل ۵ تـای اونهـا رو تهیـه کنی؛ (می‌تونی یادآور های مورد نظر خودت رو هم بنویسی)' ,
                                                               ]) ,
                                 ]);
        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'CHECKBOX' ] ,
                                     'question' => ([
                                                                       '1' => 'تهیه یک المان خاص',
                                                                       '2' => 'چسبوندن استیکر یادآور',
                                                                       '3' => 'درخواست یادآوری از یک دوست',
                                                                       '4' => 'تصویر یادآور روی صفحه لپ تاپ',
                                                                       '5' => 'متن یادآور روی صفحه گوشی',
                                                                       '6' => 'تابلو متن یادآور به دیوار'
                                                               ]) ,
                                 ]);
        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'ORDERED_LIST' ] ,
                                     'question' => ([
                                                                   'description' => 'اقدامات لازم برای تهیه
 یادآورهای مورد نیاز؛ ' ,
                                                               ]) ,
                                 ]);
    }

    public function nine(){
        $sort = 1;
        $day = 9;

        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'ORDERED_LIST' ] ,
                                     'question' => ([
                                                                   'description' => 'شناسایی سوژه هایی که
اصطکاک اجرای عادتم رو بالا میبرن' ,
                                                               ]) ,
                                 ]);

        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'NOTE' ] ,
                                     'question' => ([
                                                                   'description' => 'جمله ای که امروز بهش نیاز دارم؛ ' ,
                                                               ]) ,
                                 ]);
    }

    public function ten(){
        $sort = 1;
        $day = 10;

        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'ORDERED_LIST' ] ,
                                     'question' => ([
                                                                   'description' => 'شناسایی آپشن های زیادی؛' ,
                                                               ]) ,
                                 ]);

        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'ORDERED_LIST' ] ,
                                     'question' => ([
                                                                   'description' => 'اقدامات لازم برای محدود کردن اونها؛' ,
                                                               ]) ,
                                 ]);

    }

    public function eleven(){
        $sort = 1;
        $day = 11;

        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'ORDERED_LIST' ] ,
                                     'question' => ([
                                                                   'description' => 'عادت هایی که من رو از
مسیر دور میکنن؛ ' ,
                                                               ]) ,
                                 ]);

        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'NOTE' ] ,
                                     'question' => ([
                                                                   'description' => 'آیا حس میکنم عادتم داره
شکل میگیره؟
' ,
                                                               ]) ,
                                 ]);

    }

    public function twelve(){
        $sort = 1;
        $day = 12;

        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'ORDERED_LIST' ] ,
                                     'question' => ([
                                                                   'description' => 'اقداماتی که میتونم برای جار زدن
هویتم انجام بدم؛' ,
                                                               ]) ,
                                 ]);

        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'NOTE' ] ,
                                     'question' => ([
                                                                   'description' => 'یادآور شخصیتی که برای خودم
می‌پسندم؛ من آدمی هستم که… ' ,
                                                               ]) ,
                                 ]);

    }

    public function thirteen(){
        $sort = 1;
        $day = 13;

        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'ORDERED_LIST' ] ,
                                     'question' => ([
                                                                   'description' => 'سرنخ های تکرار عادات بد من و رفتار هایی که عادت انتخابیم رو تحت تاثیر قرار میدن اینها هستن… ' ,
                                                               ]) ,
                                 ]);

        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'NOTE' ] ,
                                     'question' => ([
                                                                   'description' => 'یادآور شخصیتی که برای خودم
می‌پسندم؛ من آدمی هستم که…
' ,
                                                               ]) ,
                                 ]);

    }

    public function fourteen(){
        $sort = 1;
        $day = 14;

        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'CHECKBOX' ] ,
                                     'question' => ([
                                                                   'items' => [
                                                                       'شناسایی پیج هایی که توی اینستاگرام به پیشرفت عادت مطلوب من کمک میکنن.',
                                                                       'شناسایی پادکست هایی که به پیشرفت عادت مورد نظر من کمک میکنن.',
                                                                       'شناسایی گروه های نزدیک به من که به پیشرفت عادت مورد نظر من کمک میکنن.',
                                                                       'شناسایی گروه هایی که مانع و خلاف رفتار مورد نظر من هستن.'
                                                                   ] ,
                                                               ]) ,
                                 ]);

        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'NOTE' ] ,
                                     'question' => ([
                                                                   'description' => 'چه کسی عادت من رو داره؟ و
چجوری می‌تونم باهاش ارتباط بگیرم؟' ,
                                                               ]) ,
                                 ]);

    }

    public function fifteen(){
        $sort = 1;
        $day = 15;

        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'ORDERED_LIST' ] ,
                                     'question' => ([
                                                                   'description' => 'بهونه هایی که تا اینجای کار
توی ذهنم رشد کردن؟
' ,
                                                               ]) ,
                                 ]);

        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'ORDERED_LIST' ] ,
                                     'question' => ([
                                                                   'description' => 'چجوری میتونم حلشون کنم؟
میتونم جذابشون کنم؟ لازم هست ذهنیتم
رو نسبت به چیزی تغییر بدم؟' ,
                                                               ]) ,
                                 ]);
    }

    public function sixteen(){
        $sort = 1;
        $day = 16;

        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'ORDERED_LIST' ] ,
                                     'question' => ([
                                                                   'description' => 'جنبش های من برای تغییر عاداتم' ,
                                                               ]) ,
                                 ]);

        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'ORDERED_LIST' ] ,
                                     'question' => ([
                                                                   'description' => 'اعمال من برای تغییر عاداتم…' ,
                                                               ]) ,
                                 ]);

        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'NOTE' ] ,
                                     'question' => ([
                                                                   'description' => 'طبق درس روز دوم، آیا متوجه چیزی شدم
که من رو از عادت جدید متنفر کنه؟
اگر بله چه اقدامی باید براش انجام بدم؟
' ,
                                                               ]) ,
                                 ]);
    }

    public function seventeen(){
        $sort = 1;
        $day = 17;

        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'ORDERED_LIST' ] ,
                                     'question' => ([
                                                                   'description' => 'خرده اعمالی که تکرار رفتار مورد نظرم
رو محتمل تر میکنن… ' ,
                                                               ]) ,
                                 ]);


        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'NOTE' ] ,
                                     'question' => ([
                                                                   'description' => 'چقدر دوست دارم این عادت جدید
توی سبک زندگیم جا بگیره؟
' ,
                                                               ]) ,
                                 ]);
    }

    public function eighteen(){
        $sort = 1;
        $day = 18;

        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'ORDERED_LIST' ] ,
                                     'question' => ([
                                                                   'description' => 'موانعی که احتمال تکرار رفتار
مورد نظرم رو کم میکنن…
' ,
                                                               ]) ,
                                 ]);


        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'NOTE' ] ,
                                     'question' => ([
                                                                   'description' => 'طبق برنامه روز چهاردهم چقدر با کسی که عادت من رو داره ارتباط گرفتم؛' ,
                                                               ]) ,
                                 ]);
    }

    public function nineteen(){
        $sort = 1;
        $day = 19;

        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'ORDERED_LIST' ] ,
                                     'question' => ([
                                                                   'description' => 'این رفتار های کوچیک من رو به
سمت عادت مورد نظرم میبرن؛
' ,
                                                               ]) ,
                                 ]);


        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'ORDERED_LIST' ] ,
                                     'question' => ([
                                                                   'description' => 'این رفتار های کوچیک من رو از
عادت مورد نظرم دور میکنن؛ ' ,
                                                               ]) ,
                                 ]);


        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'NOTE' ] ,
                                     'question' => ([
                                                                   'description' => 'جمله ای که امروز بهش نیاز دارم؛ ' ,
                                                               ]) ,
                                 ]);
    }

    public function twenty(){
        $sort = 1;
        $day = 20;

        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'SIMPLE_DESCRIPTION' ] ,
                                     'question' => ([
                                                                   'description' => 'ایجاد تنوع برای یادآور های
تهیه شده در روز هشتم؛' ,
                                                               ]) ,
                                 ]);
        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'SIMPLE_DESCRIPTION' ] ,
                                     'question' => ([
                                                                   'description' => 'یادآور هایی که نیاز به تغییر دارن
رو ویرایش کنید…' ,
                                                               ]) ,
                                 ]);

        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'CHECKBOX' ] ,
                                     'question' => ([
                                                                   '1' => 'تهیه یک المان خاص',
                                                                   '2' => 'چسبوندن استیکر یادآور',
                                                                   '3' => 'درخواست یادآوری از یک دوست',
                                                                   '4' => 'تصویر یادآور روی صفحه لپ تاپ',
                                                                   '5' => 'متن یادآور روی صفحه گوشی',
                                                                   '6' => 'تابلو متن یادآور به دیوار'
                                                               ]) ,
                                 ]);

        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'NOTE' ] ,
                                     'question' => ([
                                                                   'description' => 'آیا لازمه تغییر دیگه ای هم توی روند شکل گرفتن عادت جدیدم ایجاد کنم؟' ,
                                                               ]) ,
                                 ]);
    }

    public function twentyOne(){
        $sort = 1;
        $day = 21;

        ExerciseQuestion::query()
                        ->create([
                                     'sort' => $sort++ ,
                                     'day_id' => $day ,
                                     'type' => ExerciseQuestion::TYPES[ 'NOTE' ] ,
                                     'question' => ([
                                                                   'description' => 'طبق درس امروز این پایین بنویس چه حدی از عادتت تو رو از مسیر زده میکنه و چه حدیش باعث میشه حوصله ت سر بره و در ادامه هم همیشه این سوال رو از خودت بپرس: ' ,
                                                               ]) ,
                                 ]);
    }

}
