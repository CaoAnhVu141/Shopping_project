<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('about_contents')->insert([
            ['title' => 'Câu Chuyện Của Chúng Tôi', 
             'content' => 'Câu chuyện của Công Ty Shopping bắt đầu từ một ước mơ đơn giản nhưng đầy hoài bão: tạo ra một không gian không chỉ để mua sắm, mà còn để khơi dậy sự sáng tạo và truyền cảm hứng cho tất cả mọi người. Được thành lập vào năm 2020, chúng tôi đã đặt nền móng cho một hành trình dài, trong đó mỗi bước đi đều được xây dựng trên niềm đam mê và sự cống hiến. Chúng tôi tin rằng, mỗi sản phẩm mà chúng tôi cung cấp đều mang trong mình một phần giá trị và ý nghĩa sâu sắc, không chỉ là công cụ mà còn là nguồn động lực cho người dùng. Khi bắt đầu hành trình, chúng tôi nhận ra rằng không gian mua sắm truyền thống không thể đáp ứng được nhu cầu và kỳ vọng ngày càng cao của khách hàng hiện đại. Do đó, chúng tôi quyết tâm định nghĩa lại trải nghiệm mua sắm, không chỉ thông qua sản phẩm mà còn bằng cách xây dựng một cộng đồng. Chúng tôi mong muốn mỗi khách hàng không chỉ là người tiêu dùng mà còn là một phần của gia đình lớn này, nơi họ có thể tìm thấy sự kết nối, hỗ trợ, và hơn hết là nguồn cảm hứng để theo đuổi những đam mê của chính mình. Bằng cách đó, chúng tôi không chỉ tạo ra sản phẩm mà còn tạo ra những câu chuyện và kỷ niệm không thể nào quên.'],
            ['title' => 'Sứ Mệnh Của Chúng Tôi', 
             'content' => 'Tại Công Ty Shopping, sứ mệnh của chúng tôi không chỉ đơn thuần là cung cấp sản phẩm, mà còn là một hành trình nhằm trao quyền cho từng cá nhân. Chúng tôi tin rằng, mọi người đều xứng đáng có được những trải nghiệm tốt nhất trong cuộc sống hàng ngày của mình. Chúng tôi cam kết sử dụng những giải pháp đổi mới, kết hợp giữa công nghệ hiện đại và sự sáng tạo để mang đến cho khách hàng những sản phẩm không chỉ chất lượng mà còn chứa đựng những giá trị tinh thần sâu sắc. Mỗi sản phẩm được chúng tôi chọn lọc và phát triển không chỉ là hàng hóa; nó là sự phản ánh của triết lý sống mà chúng tôi muốn chia sẻ: “Sống có mục đích, không ngừng học hỏi và khám phá”. Chúng tôi hiểu rằng cuộc sống hiện đại mang đến rất nhiều thách thức và áp lực, và chúng tôi muốn trở thành một phần của giải pháp. Bằng cách cung cấp các sản phẩm và dịch vụ không chỉ đáp ứng nhu cầu, mà còn nâng cao chất lượng cuộc sống, chúng tôi hi vọng sẽ tạo ra một tác động tích cực lên cộng đồng. Chúng tôi tin rằng sự sáng tạo là chìa khóa để vượt qua mọi rào cản và thúc đẩy sự phát triển. Với tầm nhìn này, chúng tôi luôn cố gắng cải tiến và đổi mới, hướng đến một tương lai nơi mà mỗi người đều có thể phát triển và tỏa sáng.']
        ]);
    }
}
