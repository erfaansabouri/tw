<?php

namespace Database\Seeders;

use App\Models\PopupGroup;
use App\Models\PopupQuestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PopupSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run (): void {
        PopupGroup::truncate();
        PopupQuestion::truncate();
        $this->day1();
        $this->day2();
        $this->day3();
        $this->day4();
        $this->day5();
        $this->day6();
        $this->day7();
        $this->day8();
        $this->day9();
        $this->day10();
        $this->day11();
        $this->day12();
        $this->day13();
        $this->day14();
        $this->day15();
        $this->day16();
        $this->day17();
        $this->day18();
        $this->day19();
        $this->day20();
        $this->day21();
    }

    public function day1 () {
        $g1 = PopupGroup::query()
                        ->create();
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 1 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => 1 ,
                                  'question' => [
                                      'description' => 'اولین ماموریت امروز؛ مشخص کردن پیش نیاز عای عادت جدید، چیزایی که ممکنه از عادت دورت کنن و چیزایی که می‌تونن توی ساختن عات بهت کمک کنن.' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::ORDERED_LIST ,
                                  'sort' => 2 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => 1 ,
                                  'question' => [] ,
                              ]);
        $g2 = PopupGroup::query()
                        ->create();
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 1 ,
                                  'popup_group_id' => $g2->id ,
                                  'day_id' => 1 ,
                                  'question' => [
                                      'description' => 'ماموریت دوم؛ دوست داری چه فردی باشی؟ شخصیتت مستقیما با عاداتت در ارتباطه و اینجا لازمه ویژگی های شخصیتی جدیدت رو بنویسی.' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::ORDERED_LIST ,
                                  'sort' => 2 ,
                                  'popup_group_id' => $g2->id ,
                                  'day_id' => 1 ,
                                  'question' => [] ,
                              ]);
    }

    public function day2 () {
        $day_id = 2;
        $g1 = PopupGroup::query()
                        ->create();
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 1 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'مأموریت مهم امروز اینه: همین ابتدا کارهایی که از پروسه متنفرت می‌کنن رو یادداشت کن و کنار بذار.' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::ORDERED_LIST ,
                                  'sort' => 2 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [] ,
                              ]);
        $g2 = PopupGroup::query()
                        ->create();
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 1 ,
                                  'popup_group_id' => $g2->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'اگه کارهایی که ازشون متنفر هستی رو کنار بذاری، ممکنه احساس خلا کنی. پس بهتره برای اون‌ها جایگزین‌هایی پیدا کنی که هم مفید باشن و هم برات لذت‌بخش‌تر.' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::ORDERED_LIST ,
                                  'sort' => 2 ,
                                  'popup_group_id' => $g2->id ,
                                  'day_id' => $day_id ,
                                  'question' => [] ,
                              ]);
    }

    public function day3 () {
        $day_id = 3;
        $g1 = PopupGroup::query()
                        ->create();
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 1 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'ماموریت امروز اینه که برای عادت جدیدت یک فانتزی تعیین کنی؛ چیزهایی که دوست داری با شکل‌گیری این عادت در زندگیت داشته باشی.' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::ORDERED_LIST ,
                                  'sort' => 2 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [] ,
                              ]);
        $g2 = PopupGroup::query()
                        ->create();
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 1 ,
                                  'popup_group_id' => $g2->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'حالا بنویس که برای فردا از خودت چه انتظاراتی داری؟' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::ORDERED_LIST ,
                                  'sort' => 2 ,
                                  'popup_group_id' => $g2->id ,
                                  'day_id' => $day_id ,
                                  'question' => [] ,
                              ]);
    }

    public function day4 () {
        $day_id = 3;
        $g1 = PopupGroup::query()
                        ->create();
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 1 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => '«بلوک‌های زمانی ممنوعه»
این اسم ماموریت اول امروزمونه، لازمه یک تایم زمانی مشخص کنی که توی اون می‌خوای عادتت رو انجام بدی.' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::FILL_IN_THE_BLANK ,
                                  'sort' => 2 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'بلوک زمانی عادت من
ساعت [_] تا [_]' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_BLACK_DESCRIPTION ,
                                  'sort' => 2 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'اما چرا توی اسمش “ممنوعه” داریم؟ چون قرار نیست هیچ کار دیگه ای رو توی این زمان انجام بدی، چک کردن گوشی، تمیز کردن خونه، دوش گرفتن و حتی قدم زدن! یا باید عادتت رو اجرا کنی یا بشینی و هیچ کاری نکنی، این باعث میشه تا حد زیادی پشت گوش انداختن با کارای دیگه رو بذاریم کنار.' ,
                                  ] ,
                              ]);
        $g2 = PopupGroup::query()
                        ->create();
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 1 ,
                                  'popup_group_id' => $g2->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'ماموریت دوم امروز: احساساتی که ممکنه باعث بشن عادتت رو پشت گوش بندازی رو بنویس!' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::ORDERED_LIST ,
                                  'sort' => 2 ,
                                  'popup_group_id' => $g2->id ,
                                  'day_id' => $day_id ,
                                  'question' => [] ,
                              ]);
    }

    public function day5 () {
        $day_id = 5;
        $g1 = PopupGroup::query()
                        ->create();
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 1 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'امروز می‌خوایم یک نسخه دو دقیقه‌ای از عادتت بسازیم؛ چیزی که هر زمان احساس کردی نمی‌خوای عادتت را انجام بدی، به آن مراجعه کنی و استمرار رو حفظ کنی.

این نسخه لازمه تا جای ممکن آسون باشه، اونقدر آسون که نتونی نادیده‌ش بگیری.' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::ORDERED_LIST ,
                                  'sort' => 2 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [] ,
                              ]);
        $g2 = PopupGroup::query()
                        ->create();
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 1 ,
                                  'popup_group_id' => $g2->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'حالا بریم سراغ بهونه‌هایی که تا اینجا مانعت شدن و ببینیم چقدر انگیزه‌ات از روز اول افت کرده!' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::PERCENTAGE_WITH_TEXT ,
                                  'sort' => 2 ,
                                  'popup_group_id' => $g2->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'میزان افت انگیزه تا اینجای کار' ,
                                  ] ,
                              ]);
        $g3 = PopupGroup::query()
                        ->create();
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 1 ,
                                  'popup_group_id' => $g3->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'چه اقداماتی می‌تونی برای بالا بردن انگیزه‌ت انجام بدی؟' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::ORDERED_LIST ,
                                  'sort' => 2 ,
                                  'popup_group_id' => $g3->id ,
                                  'day_id' => $day_id ,
                                  'question' => [] ,
                              ]);
    }

    public function day6 () {
        $day_id = 6;
        $g1 = PopupGroup::query()
                        ->create();
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 1 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'امروز می‌خواهیم دوباره چیزی که در ابتدای ساختن عادت نوشتی رو مرور کنیم و ببینیم اگر لازمه، بهینه‌اش کنیم.

حالا درباره مکان و زمان اجرای عادتت فکر کن. آیا به تغییر نیاز داره؟ سه زمان جایگزین انتخاب کن و اگه یکی رو جا انداختی، برو سراغ بعدی!' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::FILL_IN_THE_BLANK ,
                                  'sort' => 2 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'من در [_] (زمان) در [_] (مکان)
[_] (رفتار) رو انجام خواهم داد.
' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::FILL_IN_THE_BLANK ,
                                  'sort' => 3 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'من در [_] (زمان) در [_] (مکان)
[_] (رفتار) رو انجام خواهم داد.
' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::FILL_IN_THE_BLANK ,
                                  'sort' => 4 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'من در [_] (زمان) در [_] (مکان)
[_] (رفتار) رو انجام خواهم داد.
' ,
                                  ] ,
                              ]);
    }

    public function day7 () {
        $day_id = 7;
        $g1 = PopupGroup::query()
                        ->create();
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 1 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'ماموریت امروز اینه که عادت جدیدت رو به یک عادت قدیمی گره بزنی. مثلاً اگه داری عادت پیاده‌روی رو ایجاد می‌کنی، می‌تونی اون رو با عادت پادکست گوش دادن ترکیب کنی.' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::FILL_IN_THE_BLANK ,
                                  'sort' => 2 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'من فقط وقتی [_] (عادت و رفتار مورد علاقه) که [_] (عادتی که سعی در ایجادش را دارید) رو انجام بدم.' ,
                                  ] ,
                              ]);
    }

    public function day8 () {
        $day_id = 7;
        $g1 = PopupGroup::query()
                        ->create();
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 1 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'ماموریت امروز: تهیه یادآور برای عادت جدیدت.

توی این جدول یادآورهایی که باید بذاری رو لیست کردیم. لازم داریم حداقل ۵ تا از اون‌ها رو تهیه کنی؛ (می‌تونی یادآورهای خودت رو هم اضافه کنی).' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::CHECKBOX ,
                                  'sort' => 1 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => ( [
                                      '1' => 'تهیه یک المان خاص' ,
                                      '2' => 'چسبوندن استیکر یادآور' ,
                                      '3' => 'درخواست یادآوری از یک دوست' ,
                                      '4' => 'تصویر یادآور روی صفحه لپ تاپ' ,
                                      '5' => 'متن یادآور روی صفحه گوشی' ,
                                      '6' => 'تابلو متن یادآور به دیوار' ,
                                  ] ) ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::ORDERED_LIST ,
                                  'sort' => 2 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'اقدامات لازم برای تهیه
 یادآورهای مورد نیاز؛ ' ,
                                  ] ,
                              ]);
    }

    public function day9 () {
        $day_id = 9;
        $g1 = PopupGroup::query()
                        ->create();
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 1 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'ماموریت امروز اینه که سوژه‌ها و موانعی که باعث سخت‌تر شدن انجام عادت جدیدت می‌شن رو شناسایی کنی و برای حذفشون تلاش کنی.

چیزهایی که تا اینجا احتمالاً متوجه‌شون شدی و می‌تونی به راحتی تشخیص‌شون بدی.' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::ORDERED_LIST ,
                                  'sort' => 2 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [] ,
                              ]);
    }

    public function day10 () {
        $day_id = 10;
        $g1 = PopupGroup::query()
                        ->create();
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 1 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'امروز می‌خوایم ببینیم گزینه‌های زیادی که ذهنت رو در مسیر ساختن عادت جدید سردرگم می‌کنن، چی هستن و اونا رو محدود کنیم به بهترین گزینه‌ها.' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::ORDERED_LIST ,
                                  'sort' => 2 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [] ,
                              ]);
        $g2 = PopupGroup::query()
                        ->create();
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 1 ,
                                  'popup_group_id' => $g2->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'همچنین ازت می‌خوایم بعد از نوشتن گزینه‌های اصلی، اقداماتی که لازمه برای محدود کردن سایز آپشن ها انجام بدی رو هم بنویسی و بهشون عمل کنی.' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::ORDERED_LIST ,
                                  'sort' => 2 ,
                                  'popup_group_id' => $g2->id ,
                                  'day_id' => $day_id ,
                                  'question' => [] ,
                              ]);
    }

    public function day11 () {
        $day_id = 11;
        $g1 = PopupGroup::query()
                        ->create();
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 1 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'توی این ده روز احتمالاً متوجه شدی کدوم عادت‌هات مانع شکل‌گیری عادت جدیدت می‌شن. ازت می‌خوایم اون‌ها رو اینجا بنویسی،

اما فعلاً لازم نیست برای تغییرشون اقدامی انجام بدی. در این مرحله فقط آگاهی ازشون کافیه.' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::ORDERED_LIST ,
                                  'sort' => 2 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [] ,
                              ]);
    }

    public function day12 () {
        $day_id = 12;
        $g1 = PopupGroup::query()
                        ->create();
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 1 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'ماموریت جذاب امروز: هویت و شخصیت جدیدت رو که باعث این عادت میشه، همه جا جار بزن. توی گروه‌های اجتماعی، شبکه‌های اجتماعی، خانواده و هر جایی که می‌تونی.

و اینجا بنویس که قراره کجا این کار رو انجام بدی.' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::ORDERED_LIST ,
                                  'sort' => 2 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [] ,
                              ]);
        $g2 = PopupGroup::query()
                        ->create();
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 1 ,
                                  'popup_group_id' => $g2->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'در قدم دوم امروز، به خودت یادآوری کن که اون شخصیت چه خصوصیاتی داره.' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::ORDERED_LIST ,
                                  'sort' => 2 ,
                                  'popup_group_id' => $g2->id ,
                                  'day_id' => $day_id ,
                                  'question' => [] ,
                              ]);
    }

    public function day13 () {
        $day_id = 13;
        $g1 = PopupGroup::query()
                        ->create();
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 1 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'خوش اومدی به روز سیزدهم! امروز ازت می‌خوایم طبق روز یازدهم، سرنخ‌های عادت‌هایی رو شناسایی کنی که تو رو از مسیر دور می‌کنن و روی حذف این سرنخ‌ها کار کنی.' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::ORDERED_LIST ,
                                  'sort' => 2 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [] ,
                              ]);
    }

    public function day14 () {
        $day_id = 14;
        $g1 = PopupGroup::query()
                        ->create();
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 1 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'ماموریت مهم امروز: روی محیط اطرافت کار کن و خودت رو در کنار افرادی قرار بده که این عادت رو دارن.' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::CHECKBOX ,
                                  'sort' => 2 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => ( [
                                      'items' => [
                                          'شناسایی پیج هایی که توی اینستاگرام به پیشرفت عادت مطلوب من کمک میکنن.' ,
                                          'شناسایی پادکست هایی که به پیشرفت عادت مورد نظر من کمک میکنن.' ,
                                          'شناسایی گروه های نزدیک به من که به پیشرفت عادت مورد نظر من کمک میکنن.' ,
                                          'شناسایی گروه هایی که مانع و خلاف رفتار مورد نظر من هستن.' ,
                                      ] ,
                                  ] ) ,
                              ]);
        $g2 = PopupGroup::query()
                        ->create();
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 1 ,
                                  'popup_group_id' => $g2->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'و اما کسایی که عادتت رو دارن و می‌تونی با اونها در ارتباط باشی' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::NOTE ,
                                  'sort' => 3 ,
                                  'popup_group_id' => $g2->id ,
                                  'day_id' => $day_id ,
                                  'question' => ( [
                                      'description' => 'چه کسی عادت من رو داره؟ و
چجوری می‌تونم باهاش ارتباط بگیرم؟' ,
                                  ] ) ,
                              ]);
    }

    public function day15 () {
        $day_id = 15;
        $g1 = PopupGroup::query()
                        ->create();
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 1 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'می‌رسیم به ماموریت امروز که به استمرار و اجرای عادت‌های گذشته وابسته‌ست.
امروز ازت می‌خوایم بهانه‌هایی که توی این مدت متوجه‌شون شدی رو بنویسی.' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::ORDERED_LIST ,
                                  'sort' => 2 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [] ,
                              ]);
        $g2 = PopupGroup::query()
                        ->create();
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 1 ,
                                  'popup_group_id' => $g2->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'حالا توی قدم دوم امروز از خودت بپرس: چطور می‌تونم این بهانه‌ها رو حل کنم؟ آیا می‌تونم جذابشون کنم؟ آیا لازمه ذهنیتم رو نسبت به چیزی تغییر بدم؟' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::ORDERED_LIST ,
                                  'sort' => 2 ,
                                  'popup_group_id' => $g2->id ,
                                  'day_id' => $day_id ,
                                  'question' => [] ,
                              ]);
    }

    public function day16 () {
        $day_id = 16;
        $g1 = PopupGroup::query()
                        ->create();
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 1 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'ماموریت امروز اینه که افکارمون رو از اقداماتی که انجام دادیم جدا کنیم.

یعنی تصورات و فانتزی‌هایی (جنبش) که برای عادت جدید داریم رو از کارهایی که واقعاً انجام دادیم(اعمال) و قراره انجام بدیم، تفکیک کنیم.' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::ORDERED_LIST ,
                                  'sort' => 2 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'جنبش های من برای تغییر عاداتم' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::ORDERED_LIST ,
                                  'sort' => 3 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'اعمال من برای تغییر عاداتم…' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 4 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'فایده این کار چیه؟ اینکه بتونیم تشخیص بدیم کجاها فقط داریم به عادت فکر می‌کنیم و کجاها لازمه که واقعاً اقداماتی انجام بدیم.
' ,
                                  ] ,
                              ]);
        $g2 = PopupGroup::query()
                        ->create();
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 1 ,
                                  'popup_group_id' => $g2->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'اما ماموریت دوم امروز: طبق درس روز دوم، آیا چیزی رو متوجه شدم که من رو از عادت جدیدم زده کنه؟ اگه بله، چه کاری باید براش انجام بدم؟' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::NOTE ,
                                  'sort' => 3 ,
                                  'popup_group_id' => $g2->id ,
                                  'day_id' => $day_id ,
                                  'question' => ( [] ) ,
                              ]);
    }

    public function day17 () {
        $day_id = 17;
        $g1 = PopupGroup::query()
                        ->create();
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 1 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'ماموریت امروز اینه که خرده‌اعمالی رو شناسایی کنی که می‌تونن بهت کمک کنن عادتت رو راحت‌تر تکرار کنی، و بعد روی بیشتر انجام دادنشون کار کنی.' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::ORDERED_LIST ,
                                  'sort' => 2 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [] ,
                              ]);
    }

    public function day18 () {
        $day_id = 18;
        $g1 = PopupGroup::query()
                        ->create();
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 1 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'تبریک می‌گیم! خوش اومدی به روز هجدهم. باید بدونی که هرکسی اینقدر پایدار و مستمر نیست که تا اینجا پیش بیاد. ادامه دادن تو واقعاً قابل تحسینه!' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 2 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'امروز ماموریت داری موانعی رو شناسایی کنی که احتمال تکرار عادتت رو کاهش میدن، و بعد روی حذفشون کار کنی.' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::ORDERED_LIST ,
                                  'sort' => 3 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [] ,
                              ]);
        $g2 = PopupGroup::query()
                        ->create();
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 1 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'اما ماموریت دوم امروز: طبق درس روز چهاردهم، تا حالا چقدر با افرادی که این عادت رو دارن ارتباط گرفتی؟' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::ORDERED_LIST ,
                                  'sort' => 3 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [] ,
                              ]);
    }

    public function day19 () {
        $day_id = 19;
        $g1 = PopupGroup::query()
                        ->create();
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 1 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'ماموریت امروز: رفتار های کوچیکی که می‌تونن تو رو از عادتت دور کنن یا بهش نزدیکت کنن رو شناسایی کن' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::ORDERED_LIST ,
                                  'sort' => 3 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'این رفتار های کوچیک من رو به
سمت عادت مورد نظرم میبرن؛ ' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::ORDERED_LIST ,
                                  'sort' => 3 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'این رفتار های کوچیک من رو از
عادت مورد نظرم دور میکنن؛ ' ,
                                  ] ,
                              ]);
    }

    public function day20 () {
        $day_id = 20;
        $g1 = PopupGroup::query()
                        ->create();
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 1 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'یادته توی روز هشتم برای خودت یادآور تعیین کردی؟ امروز ماموریتت اینه که توی اون یادآورها تنوع ایجاد کنی و اونا رو ویرایش کنی.' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::CHECKBOX ,
                                  'sort' => 3 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => ( [
                                      '1' => 'تهیه یک المان خاص' ,
                                      '2' => 'چسبوندن استیکر یادآور' ,
                                      '3' => 'درخواست یادآوری از یک دوست' ,
                                      '4' => 'تصویر یادآور روی صفحه لپ تاپ' ,
                                      '5' => 'متن یادآور روی صفحه گوشی' ,
                                      '6' => 'تابلو متن یادآور به دیوار',
                                  ] ) ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::NOTE ,
                                  'sort' => 3 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'آیا لازمه تغییر دیگه ای هم توی روند شکل گرفتن عادت جدیدم ایجاد کنم؟' ,
                                  ] ,
                              ]);
    }

    public function day21 () {
        $day_id = 21;
        $g1 = PopupGroup::query()
                        ->create();
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::SIMPLE_WHITE_DESCRIPTION ,
                                  'sort' => 1 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [
                                      'description' => 'و اما ماموریت روز آخر:
امروز قراره بنویسی چه حدی از اجرای عادت تو رو از مسیر زده می‌کنه و چه حدی از اون باعث می‌شه حوصله‌ت سر بره؟' ,
                                  ] ,
                              ]);
        PopupQuestion::query()
                     ->create([
                                  'type' => PopupQuestion::ORDERED_LIST ,
                                  'sort' => 3 ,
                                  'popup_group_id' => $g1->id ,
                                  'day_id' => $day_id ,
                                  'question' => [] ,
                              ]);
    }
}
