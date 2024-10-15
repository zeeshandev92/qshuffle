<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Question::insert(
            [
                [
                    'relation_id' => 1,
                    'gender' => 'male',
                    'question' => 'How have you been feeling lately?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'male',
                    'question' => 'What are your current goals in life?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'male',
                    'question' => 'Are you planning any trips soon?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'male',
                    'question' => 'What’s the latest movie or series you’ve watched?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'male',
                    'question' => 'What hobbies are you into these days?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'male',
                    'question' => 'How is work or school going for you?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'male',
                    'question' => 'Do you have any fitness goals you’re working on?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'male',
                    'question' => 'What do you do to relax or unwind?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'male',
                    'question' => "How’s your family doing?",
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'male',
                    'question' => 'Is there anything exciting happening in your life right now?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'female',
                    'question' => 'How have you been lately?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'female',
                    'question' => 'What’s the most exciting thing happening in your life right now?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'female',
                    'question' => 'Do you have any fun plans for the weekend?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'female',
                    'question' => 'What hobbies or activities are you currently into?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'female',
                    'question' => 'How is your family doing?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'female',
                    'question' => 'How’s your work or studies going?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'female',
                    'question' => 'What’s the best book or movie you’ve recently enjoyed?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'female',
                    'question' => 'Are you working on any personal goals at the moment?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'female',
                    'question' => 'Do you have any travel plans coming up?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'female',
                    'question' => 'Is there something exciting you’re looking forward to?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'female',
                    'question' => 'How are you feeling today?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'female',
                    'question' => 'Is there anything special you’d like to do this weekend?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'female',
                    'question' => 'What do you think we should do for our next vacation?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'female',
                    'question' => 'Is there something you’ve been wanting to talk about?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'female',
                    'question' => 'What can I do to make your day better?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'female',
                    'question' => 'How do you feel about the balance between work and our personal time?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'female',
                    'question' => 'Is there something fun we can plan for next month?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'female',
                    'question' => 'How do you feel about the goals we’re working on together?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'female',
                    'question' => 'What’s something you’re really happy about lately?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'female',
                    'question' => 'Is there something I can do to support you more?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'male',
                    'question' => 'How was your day?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'male',
                    'question' => 'Is there anything you need help with?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'male',
                    'question' => 'What’s something you’re excited about lately?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'male',
                    'question' => 'How can I make your day better?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'male',
                    'question' => 'What do you think we should plan for the weekend?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'male',
                    'question' => 'How are you feeling about our relationship these days?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'male',
                    'question' => 'Is there something we should focus on more as a couple?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'male',
                    'question' => 'What can we do to improve our time together?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'male',
                    'question' => 'What’s one thing you’ve enjoyed about our time recently?',
                    'type' => 'free_text',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'male',
                    'question' => 'Is there anything you’d like to talk about or share with me?',
                    'type' => 'free_text',
                ],
            ]
        );

        Question::insert(
            [
                [
                    'relation_id' => 1,
                    'gender' => 'male',
                    'question' => 'كيف تشعر مؤخرًا؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'male',
                    'question' => 'ما هي أهدافك الحالية في الحياة؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'male',
                    'question' => 'هل تخطط لأي رحلات قريباً؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'male',
                    'question' => 'ما هو أحدث فيلم أو مسلسل شاهدته؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'male',
                    'question' => 'ما هي الهوايات التي تمارسها هذه الأيام؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'male',
                    'question' => 'كيف تسير الأمور في العمل أو المدرسة؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'male',
                    'question' => 'هل تعمل على أي أهداف متعلقة باللياقة البدنية؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'male',
                    'question' => 'ماذا تفعل للاسترخاء أو الراحة؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'male',
                    'question' => 'كيف حال عائلتك؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'male',
                    'question' => 'هل هناك أي شيء مثير يحدث في حياتك الآن؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'female',
                    'question' => 'كيف حالك مؤخرًا؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'female',
                    'question' => 'ما هو أكثر شيء مثير يحدث في حياتك الآن؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'female',
                    'question' => 'هل لديك أي خطط ممتعة لعطلة نهاية الأسبوع؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'female',
                    'question' => 'ما هي الأنشطة أو الهوايات التي تمارسها الآن؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'female',
                    'question' => 'كيف حال عائلتك؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'female',
                    'question' => 'كيف تسير الأمور في عملك أو دراستك؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'female',
                    'question' => 'ما هو أفضل كتاب أو فيلم استمتعت به مؤخرًا؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'female',
                    'question' => 'هل تعمل على أي أهداف شخصية في الوقت الحالي؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'female',
                    'question' => 'هل لديك أي خطط سفر قادمة؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 1,
                    'gender' => 'female',
                    'question' => 'هل هناك شيء مثير تتطلع إليه؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'female',
                    'question' => 'كيف تشعر اليوم؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'female',
                    'question' => 'هل هناك شيء خاص تود القيام به في نهاية هذا الأسبوع؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'female',
                    'question' => 'ما رأيك في ما يجب أن نقوم به في عطلتنا القادمة؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'female',
                    'question' => 'هل هناك شيء كنت ترغب في التحدث عنه؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'female',
                    'question' => 'ماذا يمكنني أن أفعل لجعل يومك أفضل؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'female',
                    'question' => 'ما هو رأيك في التوازن بين العمل ووقتنا الشخصي؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'female',
                    'question' => 'هل هناك شيء ممتع يمكننا التخطيط له الشهر القادم؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'female',
                    'question' => 'ما هو رأيك في الأهداف التي نعمل عليها معًا؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'female',
                    'question' => 'ما هو الشيء الذي يجعلك سعيدًا مؤخرًا؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'female',
                    'question' => 'هل هناك شيء يمكنني فعله لدعمك أكثر؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'male',
                    'question' => 'كيف كان يومك؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'male',
                    'question' => 'هل تحتاج إلى مساعدة في شيء ما؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'male',
                    'question' => 'ما هو الشيء الذي يثير حماسك مؤخرًا؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'male',
                    'question' => 'كيف يمكنني جعل يومك أفضل؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'male',
                    'question' => 'ما الذي تعتقد أنه يجب أن نخطط له في عطلة نهاية الأسبوع؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'male',
                    'question' => 'كيف تشعر تجاه علاقتنا هذه الأيام؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'male',
                    'question' => 'ما هو أفضل شيء حدث لك هذا الأسبوع؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'male',
                    'question' => 'هل هناك شيء ترغب في تغييره في روتينك اليومي؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'male',
                    'question' => 'ما هو الشيء الذي تتطلع إليه؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
                [
                    'relation_id' => 2,
                    'gender' => 'male',
                    'question' => 'هل هناك أي شيء مثير يحدث في حياتك الآن؟',
                    'type' => 'free_text',
                    'language' => 'ar',
                ],
            ]
        );
    }
}
