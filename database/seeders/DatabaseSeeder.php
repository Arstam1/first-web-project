<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\artikell;
use App\Models\Kategori;
use App\Models\member;
use App\Models\deposit;
use App\Models\Dokumens;
use App\Models\paket;
use App\Models\gallery;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Arsal Hendrawan',
            'email' => 'arsalhendrawan@gmail.com',
            'password' => 'arsal0901',
            'balance' => '70000000'
        ]);

        User::create([
            'name' => 'Ahmad Riqas',
            'email' => 'ahmadriqas99@gmail.com',
            'password' => 'ahmadriqasn1',
            'is_admin' => '1'
        ]);

        deposit::create([
            'jenis' => 'Deposit',
            'operasi' => 'tambah',
            'jumlah' => '70000000',
            'user_id' => '1',
            'status' => 'sukses'
        ]);

        member::create([
            'user_id' => '1'
        ]);


        Dokumens::create([
            'user_id' => '1'
        ]);

        
        Kategori::create([
            'kategori' => 'Haji'
        ]);

        Kategori::create([
            'kategori' => 'Umrah'
        ]);
        
        artikell::create([
            'judul' => 'Kewajiban Haji',
            'slug' => 'kewajiban-haji',
            'gambar' => 'artikel-gambar/3XcizwRrY01TshBnUsPzCVFPasC7S3VNHkzsn3qC.jpg',
            'body' => '<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quibusdam, obcaecati temporibus aut labore reprehenderit 
            maxime quod doloribus vero</p> <p> voluptatibus blanditiis rem porro nesciunt ab ipsam omnis nam commodi! Fugit consequuntur sed 
            nihil voluptas beatae harum delectus! Temporibus dolor consectetur perferendis sapiente facilis, expedita, illum magni fugiat enim 
            voluptatem soluta quisquam aliquid voluptatum nesciunt autem qui consequatur itaque atque eveniet alias aspernatur adipisci? </p> 
            <p>Amet quo ratione cupiditate! Excepturi eius quod, aliquid alias rem dolore, non iure voluptatem consequuntur maxime voluptates 
            velit neque incidunt. Excepturi pariatur voluptas illo laborum 
            neque asperiores aut. Totam minus ipsam eaque, pariatur exercitationem modi officiis ratione nobis.</p>'
        ]);

        artikell::create([
            'judul' => 'Keutamaan Umrah',
            'slug' => 'keutamaan-umrah',
            'gambar' => 'artikel-gambar/uYtCqpRnBvh4mScrCKxUouEEhOXq9DczVFqPOZFJ.jpg',
            'body' => '<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quibusdam, obcaecati temporibus aut labore reprehenderit 
            maxime quod doloribus vero</p> <p> voluptatibus blanditiis rem porro nesciunt ab ipsam omnis nam commodi! Fugit consequuntur sed 
            nihil voluptas beatae harum delectus! Temporibus dolor consectetur perferendis sapiente facilis, expedita, illum magni fugiat enim 
            voluptatem soluta quisquam aliquid voluptatum nesciunt autem qui consequatur itaque atque eveniet alias aspernatur adipisci? </p> 
            <p>Amet quo ratione cupiditate! Excepturi eius quod, aliquid alias rem dolore, non iure voluptatem consequuntur maxime voluptates 
            velit neque incidunt. Excepturi pariatur voluptas illo laborum 
            neque asperiores aut. Totam minus ipsam eaque, pariatur exercitationem modi officiis ratione nobis este duo sre wuad foar.</p>'
        ]);

        artikell::create([
            'judul' => 'Proses Ziarah Makam Nabi',
            'slug' => 'proses-ziarah-makam-nabi',
            'gambar' => 'artikel-gambar/5T5u9HS3ltveqZsbR47HbRPBTReGdjGha56VmZq9.jpg',
            'body' => '<div>Proses ziarah ke makam Rasulullah SAW di Madinah Almunawaroh, saat ini terasa berbeda dengan sebelumnya.<br><br>Dulu, biasanya modelnya dulu duluan. Kuat kuatan. Yang duluan dan kuat dapat. Pokoknya semua serba rebutan untuk bisa masuk ke raudhoh yang menjadi tempat makam Nabi Muhammad.<br><br>Saking berebutnya, saking banyaknya manusia yang bertumpuk di pusaran sekitar raudhoh, sholat pun kesulitan.Kalau toh bisa sholat di sekitar raudhoh, berdiri tidak kokoh karena bodi kesenggol senggol jamaah yang terus berlalu lalang mencari tempat dekat raudhoh untuk bersholat dan berdoa.<br><br>Meskipun masih tetap sholat dengan berdiri yang tidak kokoh tersebut, saat mau rukuk pun bisa nubruk punggung atau pun pantat jamaah lainnya karena terlalu dempet dempetan saat sholat. Bukan rukuk saja yang jadi problem, saat mau sujud pun kepala nyari posisi untuk benar-benar bisa sujud. Karena space untuk sujud super sedikit akibat jumlah umat Islam yang berebut bisa sholat di raudhoh terlalu besar jumlahnya.<br><br>Maka wajar di raudhoh, banyak askar teriak-teriak mengamankan jamaah, dan tidak segan segan mengusir yang sholatnya lama atau berdoanya lama. Yang tetap bandel berdiri di tempat sholat, jangan heran karena bisa diangkat askar untuk didorong keluar area plus kena pentungan.<br><br>Namun kondisi seperti itu agak berubah sedikit mulai sekitar 2016, dimana pola masuk ke area raudhoh dibuat dengan batasan garis. Para askar membatasi dengan memegang tali dari ujung ke ujung yang dibuat perkelompok mulai 1,2,3,4 dan 5.<br><br>Ketika tali 1 di dekat raudhoh dibuka, jamaah yang berada di arena tali 1 diijinkan masuk ke area raudhoh untuk sholat maupun berdoa. Sementara kelompok lain yang sudah menunggu di garis kotak 2,3,4 dan 5 tetap menunggu giliran berikutnya. Namun, pola ini tidak bertahan lama karena masih berkesan tak beraturan.<br><br>Mulai 2021 setelah covid model ziarah ke makam Rasululloh berubah lagi. Sistem ziarah dibuat dengan pola mendaftar ke tim ziarah. Pengelola ziarah hanya menerima pendaftaran perkelompok yg dibawa biro umroh/haji. Sistem per biro ini menjadi lebih baik karena jadwal waktu ziarah lebih pasti dan dijamin tidak rumit.<br><br>Karena jamaah yang ingin ziarah sudah ditentukan waktunya sesuai waktu pendaftaran. Para calon ziarah ini, sesuai jadwal diminta antre dan baris secara rapi di dekat pintu raudhoh.<br><br>Hasilnya lumayan baik dan banyak jamaah puas, karena dengan sistem ini, setiap rombongan jamaah dapat giliran 3-5 menit untuk berada di area raudhoh. Lumayan, sholat dan berdoa menjadi lebih khusuk.<br><br>Namun pola yang sudah baik ini, mulai dimodifikasi lagi di 2023, dimana untuk ziarah tahapannya bertambah. Yang semula, diawali pendaftaran oleh pempinpin rombongan umroh haji, kemudian sesuai jadwal jamaah baris antre di tempat yang sudah ditentukan lalu menunggu giliran masuk raudhoh.<br><br>Tetapi sekarang ada perubahan lagi: mendaftar, mengantre, transit di tempat lain lagi yang waktu menunggunya cukup lama 40 menit, baru menunggu giliran ziarah.<br><br>Perubahan ini membuat proses menuju ziarah menjadi lebih lama, namun hasilnya lumayan menjadi lebih baik: jamaah tetap bisa khusuk sholat dan berdoa di raudhoh. Namun waktu ziarah tetap terbatas karena jumlah jamaah umroh saat pasca covid menjadi meningkat pesat</div>'
        ]);

        artikell::create([
            'judul' => 'Melewati Miqot dan Baru Berihram dari Jeddah',
            'slug' => 'melewati-miqot-dan-baru-berihram-dari-jeddah',
            'gambar' => 'artikel-gambar/K9MeGzomGUNq24ecjswjxgrssBYyuApPb3FrRp5Z.jpg',
            'body' => '<div>Sebagian jama’ah haji dari tanah air yang biasa dari gelombang (kloter) belakangan, biasanya langsung akan menuju Mekkah tanpa ke Madinah dahulu. Kasusnya juga bisa terjadi pada sebagian jama’ah umrah yang langsung menuju Mekkah. Masalahnya, ada yang ditemukan berihram dari Jeddah. Padahal jika kita datang dari Indonesia, maka bisa jadi kita akan melewati Miqot Qornul Manazil, Dzat ‘Irqin atau Yalamlam. Maka seharusnya ketika ingin melewati miqot tersebut dalam keadaan ihram. Namun demikianlah karena tidak memahami masalah ini, sebagian keliru dan berihram baru dari Jeddah.<br><br></div><div>Mengenai masalah yang sama pernah ditanyakan oleh seseorang yang berasal dari Riyadh kepada Syaikh ‘Abdul ‘Aziz bin Baz <em>rahimahullah</em>, mufti Kerajaan Saudi Arabia di masa silam. Riyadh secara geografis berada di sebelah timur kota Mekkah. Dan jika ingin memasuki Mekkah dari kota Riyadh, biasa akan melewati miqot Qornul Manazil. Soal yang ditanyakan kepada Syaikh<em> rahimahullah</em> adalah sebagai berikut:<br><br></div><div>Kami tinggal di Riyadh. Setiap Ramadhan kami pergi untuk berumrah. Selama tiga tahun, jika kami pergi Umrah ke Mekkah, kami melewati Jeddah. Kami tidak langsung pergi ke Mekkah, namun kami terlebih dahulu menginap di Jeddah. Baru pada hari kedua, kami pergi ke Mekkah dan kami berniat umrah dari Jeddah. Apa hukum umrah yang telah kami lakukan selama tiga tahun tersebut? Karena kami tidaklah langsung pergi ke Mekkah namun terlebih dahulu menginap di Jeddah dan berumrah dari sana. Apakah kami punya kewajiban yang harus ditunaikan? Tolonglah berilah nasehat pada kami. <em>Jazakumullah khoiron.<br></em><br></div><div>Beliau <em>rahimahullah</em> menjawab,</div><div>Jika ihram untuk umrah kalian dimulai dari Jeddah sedangkan kalian datang dari Riyadh untuk umrah, maka kalian punya <strong>kewajiban </strong><strong><em>damm</em></strong>. Setiap kalian yang berumrah terkena kewajiban <em>damm</em> untuk setiap tiga kali umrah yang kalian lakukan. <strong>Lakukan penyembelihan di Mekkah dan berikan kepada fakir-miskin</strong>. Karena kalian punya kewajiban berihram dari miqot. Dan ihram kalian adalah dari miqot di Thoif yaitu <em>Wadi Qorn </em>(Qornul Manazil). Tidak boleh kalian sampai ke Jeddah tanpa terlebih dahulu berihram. Kalian tetap wajib berihram dari miqot. Jika kalian telah berihram, lalu kalian menginap di Jeddah, maka tidaklah masalah. Kalian kala itu sudah <em>muhrim</em> (berihram) dan jika kalian menginap di Jeddah setelah itu ke Mekkah, maka tidaklah masalah. Sedangkan jika kalian melewati miqot lantas kalian berumrah dari Jeddah yaitu berihram dari Jeddah, hal itu tidak dibolehkan. Yang melakukan seperti ini, wajib menunaikan fidyah, yaitu wajib melakukan penyembelihan di Mekkah untuk dibagikan pada fakir miskin di Mekkah sebagai penutup dari kesalahan umrah yang kalian lakukan. Ketika itu umrah tersebut mengalami kekurangan. Jika kalian berihram dari Jeddah, umrah kalian berarti ada kekurangan.<br><br></div><div>Akan tetapi jika kembali ke miqot lalu berihram dari sana (bukan dari Jeddah), boleh seperti itu. Jika engkau ingat, maka segera kembali ke miqot dan berihram dari sana, seperti itu tidak masalah. Namun perlu diperhatikan bahwa wajib jika melewati miqot dalam keadaan berihram dari miqot. Karena niatan datang ketika itu adalah untuk umrah sehingga tidak boleh melewatinya kecuali telah berihram terlebih dahulu, ini wajib. Seandainya menetap di Jeddah dan bermalam di sana dalam keadaan telah berihram, seperti itu tidak mengundang masalah. Sedangkan jika seseorang melewati miqot tanpa ihram, baru kemudian berihram dari Jeddah, ini yang tidak dibolehkan. Sekali lagi yang melakukan seperti ini punya kewajiban fidyah. …</div><div>Sebagaimana Nabi <em>shallallahu ‘alaihi wa sallam </em>telah menetapkan miqot,<br><br></div><div dir="rtl">هُنَّ لَهُنَّ وَلِمَنْ أَتَى عَلَيْهِنَّ مِنْ غَيْرِهِنَّ ، مِمَّنْ أَرَادَ الْحَجَّ وَالْعُمْرَةَ ، وَمَنْ كَانَ دُونَ ذَلِكَ فَمِنْ حَيْثُ أَنْشَأَ ، حَتَّى أَهْلُ مَكَّةَ مِنْ مَكَّةَ</div><div><br>“<em>Itulah ketentuan masing-masing bagi setiap penduduk negeri-negeri tersebut dan juga bagi mereka yang bukan penduduk negeri-negeri tersebut jika hendak melakukan ibadah haji dan umroh. Sedangkan mereka yang berada di dalam batasan miqot, maka dia memulai dari kediamannya, dan bagi penduduk Mekkah, mereka memulainya dari di Mekkah</em>.”<a href="file:///D:/Rumaysho.com%20Creation/Fikih%20Islam/Haji%20Umrah/36%20Melewati%20Miqot%20dan%20Berihram%20dari%20Jeddah.doc#_ftn1">[1]</a> Dalam lafazh lain disebutkan, “<em>Sedangkan yang berada dalam batasan miqot, maka dia mulai berihram dari tempat ia berada</em>.”<br><br></div><div>Jika mereka adalah orang yang menetap di Jeddah atau bukan menetap dari awal namun mereka bermukim di sana untuk keperluan kerja, ketika mereka hendak haji atau umrah, maka mereka boleh berihram dari tempat mereka berada. Begitu pula jika ada orang yang berasal dari Riyadh, dari Jeddah, atau tempat lainnya, atau dari Madinah, lalu ia ke Jeddah bukan untuk maksud umrah atau haji, ia datang dari kota-kota di luar Jeddah semisal dari Riyadh, Madinah, Syam, Mesir atau selainnya untuk keperluan khusus di Jeddah, seperti bekerja, mengunjungi kerabat, berdagang atau semacam itu, maka ia boleh mulai ihram untuk haji atau umrah dari Jeddah dari tempat ia mukim. Orang ini berihram dari Jeddah sebagaimana orang yang bermukim di sana. <strong>Orang seperti ini ketika melewati miqot bukan dengan niatan umrah atau haji.</strong> Ia baru berkeinginan untuk umrah atau haji ketika berada di Jeddah. Inilah orang yang baru berniatan umrah atau haji lantas berihram dari Jeddah sebagaimana orang-orang yang mukim di sana.<br><br></div><div>Itu berarti ia tidak berihram dari miqot? Iya benar, itu bukan miqot menurut yang lain. Namun itu adalah miqot baginya yaitu bagi penduduk Jeddah dan yang mukim di sana.</div><div>(Sumber fatwa: <a href="http://www.binbaz.org.sa/mat/13241">http://www.binbaz.org.sa/mat/13241</a>)</div><div>Semoga Allah memberi taufik dan hidayah.</div><div><br>Sumber <a href="https://rumaysho.com/2805-melewati-miqot-dan-baru-berihram-dari-jeddah.html">https://rumaysho.com/2805-melewati-miqot-dan-baru-berihram-dari-jeddah.html</a></div>'
        ]);

        gallery::create([
            'keterangan' => 'Kumpul Di Bandara',
            'gambar' => 'gallery-gambar/s7B3e4f7VsTKiV0NOf5w0vrAGkbUVu5tBCqpyhqI.jpg'
        ]);

        gallery::create([
            'keterangan' => 'Dokumentasi Di Madinah',
            'gambar' => 'gallery-gambar/iyrikZYIhtdxyhM5GyUJ9ewSiRekHSWagSp3J5zS.jpg'
        ]);
        
        // paket::create([
        //     'gambar' => 'paket-gambar/CifmIneIGnFnjT9vdIIgdmTycN5uWIsL4aZ9Drg9.jpg',
        //     'kategori_id' => '1',
        //     'nama' => 'Haji Furadah',
        //     'harga' => '280000000',
        //     'triple' => '284000000',
        //     'duo' => '288000000',
        //     'durasi' => '40 hari',
        //     'deskripsi' => '<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quibusdam, obcaecati temporibus aut labore reprehenderit 
        //     maxime quod doloribus vero</p> <p> voluptatibus blanditiis rem porro nesciunt ab ipsam omnis nam commodi! Fugit consequuntur sed 
        //     nihil voluptas beatae harum delectus! Temporibus dolor consectetur perferendis sapiente facilis, expedita, illum magni fugiat enim 
        //     voluptatem soluta quisquam aliquid voluptatum nesciunt autem qui consequatur itaque atque eveniet alias aspernatur adipisci? </p> 
        //     <p>Amet quo ratione cupiditate! Excepturi eius quod, aliquid alias rem dolore, non iure voluptatem consequuntur maxime voluptates 
        //     velit neque incidunt. Excepturi pariatur voluptas illo laborum 
        //     neque asperiores aut. Totam minus ipsam eaque, pariatur exercitationem modi officiis ratione nobis este duo sre wuad foar.</p>',
        //     'slug' => 'haji-furadah',
        //     'tanggal_berangkat' => '2024-06-23',
        //     'seat' => '23',
        //     'total_seat' => '23'
        // ]);

        paket::create([
            'gambar' => 'paket-gambar/456.jpeg',
            'kategori_id' => '2',
            'nama' => 'Umrah Scoot Agustus',
            'harga' => '27500000',
            'triple' => '28500000',
            'duo' => '30500000',
            'durasi' => '13 Hari',
            'deskripsi' => '<div>PROGRAM 13 HARI</div><div>🛫 Scoot Airlines</div><div>(Direct Flight)</div><div>HOTEL</div><div>🏨 Mekkah *3</div><div>Ajyad Al Jiwar / Setaraf</div><div><br>🏨 Madinah *3</div><div>Sanabel / Setaraf</div><div><br></div><div>Paket Kamar :</div><div>Quad&nbsp; &nbsp; &nbsp; : 27.500.000</div><div>Tripel&nbsp; &nbsp; &nbsp;: 28.500.000</div><div>Double&nbsp; &nbsp; : 30.500.000<br><br></div><div>Dp hanya 👉🏻 Rp.5.000.000</div>',
            'slug' => 'umrah-scoot-agustus',
            'tanggal_berangkat' => '2024-08-9',
            'seat' => '23',
            'total_seat' => '23'
        ]);

        paket::create([
            'gambar' => 'paket-gambar/123.jpeg',
            'kategori_id' => '2',
            'nama' => 'Umrah 13 Hari September',
            'harga' => '38000000',
            'triple' => '39500000',
            'duo' => '42000000',
            'durasi' => '13 Hari',
            'deskripsi' => '<div>PROGRAM 13 HARI</div><div>🛫 Lion Air</div><div>(Direct Flight Makassar - Jeddah)<br><br></div><div>HOTEL</div><div>🏨 Mekkah</div><div>Taibah / Setaraf</div><div><br>🏨 Madinah</div><div>Pullman Zam Zam / Setaraf</div><div><br></div><div>Paket Kamar :</div><div>Quad&nbsp; &nbsp; &nbsp; : 48.000.000</div><div>Tripel&nbsp; &nbsp; &nbsp;: 49.500.000</div><div>Double&nbsp; &nbsp; : 52.000.000<br><br></div><div>Dp hanya 👉🏻 Rp.5.000.000</div>',
            'slug' => 'umrah-13-hari-september',
            'tanggal_berangkat' => '2024-08-30',
            'seat' => '45',
            'total_seat' => '45'
        ]);
        
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}



