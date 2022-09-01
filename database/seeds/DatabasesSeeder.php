<?php

use Illuminate\Database\Seeder;

use App\CaseStudies;
use App\Diseases;
use App\Symptoms;

class DatabasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $diseases = [
            // 1
            [
                'nama_penyakit' => 'Layu Fusarium (Fusarium Oxysporum)',
                'deskripsi' => '<p>Tanaman tampak layu seperti kekurangan air, pada pagi dan sore hari tanaman tampak segar bila tidak ditanggulangi, dalam 2-3 hari saja tanaman akan mati kering, berwarna coklat dan batangnya mengerut. Layu fusarium bisa mnyerang tanaman semangka kapan saja, terutama pada musim hujan. Pada musim hujan jamur fusarium oxysporum mudah berkembang biak dan mudah menyebar dari satu tanaman ketanaman lainnya. Tingkat kelembapan udara yang tinggi sangat berpengaruh terhadap perkembangan jamur, terlebih lagi jika terjadi genangan air hujan dilahan dan ph tanah yang rendah.</p>
                                <p>Sementara itu, inisiasi infeksi dari penyakit ini terjadi pada batang bagian bawah tanaman yang bersinggungan dengantanah. Bagian tersebut membusuk dan berwarna coklat. Infeksi menjalar ke akr sehingga mengalami busuk basah, apabila kelembapan tanah cukup tinggi, bagian batang bagian bawah yang semula busuk kering tersebut berubah warna menjadi putih keabu-abuan karena terbentuk masa spora. Tidak hanya itu, serangan layu fusarium  juga dapat menjalar pada bagian ranting tanaman dan berakhir pada layunya daun tanaman yang kemudian dapat menyebabkan kematian pada tanaman.<br>Serangan layu fusarium sering sekali dijumpai pada tanaman yang berusia mudah maupun yang sudah tua.</p>
                                <p>Gejala  yang sering ditunjukkan yaitu tanaman akan tampak layu pada pukul 10:00-14:30(selama siang hari) dan akan kembali tampak segar pada pagi serta sore hari selama proses fotosintesis. Sekilas gejala ini  mirip dengan layu bakteri,namun bedanya adalah pada lamanya fase infeksinya. Pada layu bakteri, tanaman akan langsung mati kering dalam 2-3 hari sedangkan layu fusarium akan tampak layu dan semakin parah sehingga mati membutuhkan waktu sekitar 7-10 hari. Hingga saat ini memang velum ditemukan fungisida kimia yang benar-benar efektif untuk mengatasi serangan layu fusarium. Namun demekian jamur patogen ini tetap bisa dikendalikan populasinya pada lahan pertanian. (sardiono,2014)</p>',
                'gambar' => 'fusarium.jpg',
                'gejala' => [1, 4, 8, 10, 16, 19]
            ],
            // 2
            [
                'nama_penyakit' => 'Phytophthora ',
                'deskripsi' => '<p>Kapang ini menyebabkan timbulnya buah busuk basah pada tanaman semangka. Pada bagian yang busuk bila iklim senantiasa lembab akan tumbuh dan berkembang miselia dan sporangia berwarna putih dari kapang ini. Penyakit ini cukup merugikan bagi petani buah semangka. Spora jamur penyebab penyakit dapat menyebar melalui air drainase, percikan air hujan di permukaan tanah, manusia, hewan, alat-alat pertanian, stek tanaman atau bagian tanaman sakit, bibit tanaman terifeksi dan melalui udara/angin. Selain itu, penyakit busuk pangkal batang juga dapat menyebar melalui kontak akar tanaman sakit dan sehat.</p>
                                <p>Biologis , mencegah terjadinya infeksi phytophthora capsici karena akarnya mengandung agans hayati seperti trichoderma sp, pemeberian agens hayati (trichoderma sp) dengan dosis 500 kg/ha</p>
                                <p>Kimiawi , penyemprotan atau penaburan fungisida sistemik yang berbahan aktif aluminium fosetil 80% dan pemberian fungisida dilakukan pada awla musim hujan dan selama musim hujan.</p>',
                'gambar' => 'phytophthora.jpg',
                'gejala' => [2, 7, 18]
            ],
            // 3
            [
                'nama_penyakit' => 'Antraknosa (Collectotrichum Lagenarium)',
                'deskripsi' => '<p>Penyakit antraknosa adalah penyakit yang disebabkan oleh cendawan/jamur colletotrichum capsici dan colletotrichum gleoeosproioides. Penyakit antranoksa biasanya menyerang tanaman semangka bagian buah, batang dan daun.</p>
                                <p>Cendawana pada buah akan masuk kedalam ruang biji lalu mengifeksi biji, sehingga dapat menginfeksi persemaian yang tumbuh dari benih yang sakit. Cendawana yang menyerang bagian daun dan batang tidak dapat menginfeksi buah. Cendawana dapat bertahan dalam sisa-sisa tanaman sakit.</p>
                                <p>Gejala penyakit ini adalah pada daun terlihat bercak-bercak coklat akhirnya berubah menjadi kemerah-merahan dan akhirnya daun menjadi mati, bila menyerang buah tampak bulatan berwarna merah jambu yang lama kelamaan semakin meluas (Sardiono,2014).</p>
                                <p>Cara pengandilian penyakit antranoksa antara lain adalah pengendalian secara bercocok tanam yang meliputi penggunaan bibit yang sehat, pergiliran tanaman, perbaikan drainase dan penentuan waktu tanam. Pengendalian secara kimiawi dapat dilakukan dengan menggunakan fungisida yang efektif yang telah diizinkan oleh menteri pertanian. Sedangkan pengendalian secara fisik/mekanik dapat dilakukan dengan cara eradikasi selektif serta senantiasa kebun. Penyebab penyakit ini adalah disebabkan oleh jamur collectotrichum lagenarium</p>',
                'gambar' => 'antraknosa.jpg',
                'gejala' => [3, 13, 14, 17]
            ],
            // 4
            [
                'nama_penyakit' => 'Virus Mosaik',
                'deskripsi' => '<p>Penyakit virus mosaik pada tanaman semangka dapat disebabkan oleh virus secara tunggal ataupu gabungan. Umumnya penyakit virus mosaik disebabkan aleh gabungan beberapa virus, yaitu CMV, PVY, dan TMV. Daur penyakit, partikel CMV berbentuk bulat. Virus mosaik ditularkan secara mekanik dan dengan perantaraan vektor kutu daun persik (Myzus persicae) dan A. gosypii</p>
                                <p>Pengendalian penyakit ini yaitu srangga vector virus harua dicegah dengan menggunakan insektisida. Belum ditemukan obat yang tepat untuk mengendalikan virus ini, sehingga tanaman yang terlanjur terkena virus ini harus dicabut dan dibakar.</p>
                                <p>Gejala : yang ditinmbulakn oleh penyakit ini adalah daun melepuh, belang-belang, cenderung berubah bentuk, tanaman kerdil dan timbul rekahan membujur pada batang. Daunn menunjukkan gejala mottle mirip gejala tobacca mosaic virus (TMV). Gejala karakteristik adalah bentuk daun seperti tali sepatu yang dapat dikacaykan dengan gejala TMV yaitu malformasi daun ( fern-leaf). Penyebab: penyakit ini adalah virus yang terbawah oleh hama tanaman yang berkembang pada daun.</p>',
                'gambar' => 'mosaik.jpg',
                'gejala' => [4, 10, 19]
            ],
            // 5
            [
                'nama_penyakit' => 'Powdery Mildew (Spaerotheca Fuliginea Schlech)',
                'deskripsi' => '<p>Penyakit embun tepung (powdery mildews) pada tanaman labu-labuan tersebar diseluruh dunia. Diindonesia penyakit  ini terdapat pada semangka dan melon. Penyakit embun tepung yamg ringan dapat menurunkan mutu hasil, karena mengurangi kandungan gula buah, mengurangi aroma, dan gambar jala pada permukaan buah menjadi tidak baik. Penyakit embun tepung diketahui menyerang banyak tanaman antara lain semangka, timun, pare melon, dan lain-lain. Belum diketahu secara jelas, darimana pertama kali penyakit ini ditemukan, yang jelas wilayah penyebarannya cukup luas yang hampir keseluruh dunia.</p>
                                <p>Gejala : pada daun atau bunga muda tampak dilapisi semacam tepung berwarna putih. Bila seluruh daun terkena serangan, daun menjadi cokelat dan mengkeriput. Pertumbuhan tanaman terhambat, tanaman menjadi lemah. Pada aserangan yang cukup hebat, daun dan batang itu akan mati. Buah yang dihasilkan menderita luka bakar oleh panas matahari</p>
                                <p>Penyebab :Spaerotheca fuliginea Schleeh; Erysiphecichhoracearum DC ex Merat</p>',
                'gambar' => 'powdery-mildew.jpg',
                'gejala' => [2, 7, 18]
            ],
            // 6
            [
                'nama_penyakit' => 'Busuk Buah',
                'deskripsi' => '<p>Penyakit busuk buah disebabkan oleh phitopthora capsici leonian. Jamur menginfeksi buah stelah buah masak dan aktif setelah buah dipetik</p>
                                <p>Gejala : terjadi bercak kebasah-basahan, yang berubah menjadi cokelat dan lunak dan akhirnya bercak mengendap dan berkerut.</p>
                                <p>Pengendalian penyakit ini yaitu dengan cara: hindari dan cegah terjadinya kerusakan kulit buah, baik selama pengangkutan maupun penyimpanan, pemetikkan buah dilakukan pada waktu siang hari keteika tidak berawan/hujan, tanaman dan buah disemprot fungsida secara periodik.</p>',
                'gambar' => 'busuk-buah.jpg',
                'gejala' => [6]
            ],
            // 7
            [
                'nama_penyakit' => 'Daun Keriting',
                'deskripsi' => '<p>Penyakit  pada tanaman semangka yang satu ini bisa disebabkan oleh berbagai hal. Penyakit daun kurang bisa juga disebabkan oleh musim kemarau dan kutu daun yang menyerap cairan dalam daun semangka. Cara mengatasi daun semangka keriting memang cukup sulit. Akan tetapi, masyarakat bisa menggunakan perpaduan zat anatar zpt auxin dan sitokinin dengan interval penggunaan 3 sampai 5 hari sekali. Selain itu, masyarakat juga bisa menambahkan pupuk organik cair GDM Spesialis buah-buahan yang memiliki nutrisi lengkap untuk mempercepat menumbuhkan tunas hijau baru yang sehat.</p>',
                'gambar' => 'daun-keriting.jpg',
                'gejala' => [7]
            ],
            // 8
            [
                'nama_penyakit' => 'Cemong Buah',
                'deskripsi' => '<p>Penyakit cemong buah ini merupakan salah satu penyakit pada tanaman semangka yang sulit untuk diobati. Hal ini tersebut dikarenakan penyebaran penyakit ini begitu cepat antara satu tanaman dengan tanaman lain. Penyakit tanaman semangka yang satu ini ditandai dengan adanya pembusukkan berupa cemong pada kulit buah. Meskipun pada kulit buah hanya terlihat cemong, sebenarnya bagian dalam buah sudah sangat busuk dan tidak bisa dimakan lagi. Masyarakat harus melakukan pencegahan agar tanaman anda tidak terkena penyakit yang satu ini. Caranya adalah dengan mengombinasikan bakterisida sistematik dengan fungsida sistemik yang memiliki kandungan bahan aktif mancozeb. Campuran kedua bahan ini dilakukan untuk pencegahan agar tanaman semangka tidak terkena penyakit cemong buah. Petani bisa melakukan penyemprotan ini pada 3 sampai 5 hari sekali. Namun agar tidak terjadi serangan penyakit lakukan pencegahan mulai dari dengan mengaplikasikan Granule Bio Organik GDM SAME dan GDM Black Bos saat diolah tanah karena kedua produk ini mengandung berbagai macam bakteri menguntungkan yang memiliki sifat antagonis terhadap penyebab penyakit cemong buah semangka.</p>',
                'gambar' => 'cemong-buah.jpg',
                'gejala' => [8, 11, 14, 17]
            ],
            // 9
            [
                'nama_penyakit' => 'Bercak Daun',
                'deskripsi' => '<p>Penyakit bercak daun pada tanaman semangka biasanya terjadi disebabkan oleh jamur dan bakteri yang ada saat musim penghujan. Tingginya kelmbapan udara membuat jamur dan bakteri disekitar tanaman semangka lebih mudah berkembang. </p>
                                <p>Daun tanaman semangka yang terkena penyakit bercak daun biasanya akan memiliki bercak kuning atau hitam, bercak kuning pada daun biasanya disebabkan oleh jamur, sementara bercak hitam pada daun biasanya disebabkan oleh bakteri. Jika bercak daun semangka disebabkan oleh jamur, maka petani bisa menggunakan fungisida sebagai obatnya. Akan tetapi, jika bercak daun semangka disebabkan oleh bakteri, maka petani bisa menggunakan bakterisida sebagai obatnya. Sebelum penggunaan fungisida/bakterisida secara kimiawi alangkah baiknya penyakit ini dicegah secara hayati, yaitu dengan menggunakan bakteri yang bersifat antagonis terhadap penyakit bercak daun. Saat olah tanah petani bisa menggunakan GDM Black Bos sebab berfungsi sebagai pembenah menghilangkan berbagai macam penyakit,sertakan kombinasikan Granule Bio Organik GDM SAME akan memberikan nutrisi untuk menambah daya imunitas tanaman sehingga tanaman semangka tidak terserang penyakit ini.</p>',
                'gambar' => 'bercak-daun.jpg',
                'gejala' => [1, 9, 15]
            ],
            // 10
            [
                'nama_penyakit' => 'Layu Bakteri',
                'deskripsi' => '<p>Penyakit layu bakteri merupakan penyakit utama pada tanaman semangka, kentang, dan cabai. Penyakit ini disebabkan oleh bakteri ralstonia solanacearum, dauhulu dikenal dengan nama pseudomonas solanacearum merupakan bakteri tular tanah yang menyebabkan layu pada tanaman budidaya. Bakteri ini berkembang biak pada lingkungan yang bersuhu 30-35derajat celcius, dan berkelembapan tinggi , patogen ini dapat menyebar melalui tanah dan dapat bertahan hidup pada tanah serta sisa-sisa tanaman dalam waktu lama. Gejala yang terjadi ditunjukkan oleh serangan bakteri ini adalah layu pada daun tanaman. Daun-daun mudah akan layu hingga keujung percabangan pada waktu cuaca panas, kemudian akan terlihat segar pada malam hari ketika cuaca sedang dingin. Beberapa daun mudah layu dan daun tua bagian bawah menguning, apabila bagian tanaman yang terinfeksi (batang, cabang, dan tangkai daun) dibelah akan tampak pembuluh berwarna coklat. </p>
                            <p>Pada penyakit  stadium lanjut apabila batang dipotong akan keluar lendir bakteri berwarna putih susu. Lendir ini dapat dipakai untuk membedakan penyakit layu bakteri dengan layu fusarium. Bakteri ini menginfeksi inangnya melalui akar sejak dilakukan pindah tanam selain itu bakteri ini juga dapat menginfeksi tanaman melalui luka yang terdapat pada tanaman yang di sebabkan oleh nematode, siput dan serangga hama lainnya. </p>',
                'gambar' => 'layu-bakteri.jpg',
                'gejala' => [10, 15, 18]
            ]
        ];

        $symptoms = [
            [
                'nama_gejala' => 'Tanaman tampak layu',
                'bobot' => rand(1, 10),
            ],
            [
                'nama_gejala' => 'Kapang ini menyebabkan timbulnya buah busuk basah pada tanaman semangka.',
                'bobot' => rand(1, 10)
            ],
            [
                'nama_gejala' => 'Daun terlihat bercak-bercak coklat dan kemudian berubah menjadi merah',
                'bobot' => rand(1, 10)
            ],
            [
                'nama_gejala' => 'Tanaman mengalami layu permanen',
                'bobot' => rand(1, 10)
            ],
            [
                'nama_gejala' => 'daun belang-belang cenderung berubah bentuk',
                'bobot' => rand(1, 10)
            ],
            [
                'nama_gejala' => 'Infeksi virus yang dibawa oleh kutu daun aphids atau thrips',
                'bobot' => rand(1, 10)
            ],
            [
                'nama_gejala' => 'Adanya pembusukkan berupa cemong pada kulit buah',
                'bobot' => rand(1, 10)
            ],
            [
                'nama_gejala' => 'daun bercak kuning atau hitam',
                'bobot' => rand(1, 10)
            ],
            [
                'nama_gejala' => 'Batang berwarna coklat, rebah kemudian mati',
                'bobot' => rand(1, 10)
            ],
            [
                'nama_gejala' => 'Tanaman mengalami layu permanen',
                'bobot' => rand(1, 10)
            ],
            [
                'nama_gejala' => 'Daun dan batang dilapisi semacam tepung berwarna putih',
                'bobot' => rand(1, 10)
            ],
            [
                'nama_gejala' => 'Tanaman kerdil dan timbul rekahan membujur',
                'bobot' => rand(1, 10)
            ],
            [
                'nama_gejala' => 'Daun mengerut sampai keriting',
                'bobot' => rand(1, 10)
            ],
            [
                'nama_gejala' => 'Daun melepuh, belang-belang, dan cenderung berubah bentuk',
                'bobot' => rand(1, 10)
            ],
            [
                'nama_gejala' => 'Tanaman tumbuh kerdil, dan ruas batang memendek',
                'bobot' => rand(1, 10)
            ],
            [
                'nama_gejala' => 'Adanya bulatan berwarna merah jambu pada buah',
                'bobot' => rand(1, 10)
            ],
            [
                'nama_gejala' => 'Daun dan batang menjadi coklat dan mengkerut',
                'bobot' => rand(1, 10)
            ],
            [
                'nama_gejala' => 'Daun melepuh belang-belang dan berubah bentuk menjadi mengkerut',
                'bobot' => rand(1, 10)
            ],
            [
                'nama_gejala' => 'Adanya bercak hitam kecoklatan berbentuk bulat dan menyebar hingga daun mongering',
                'bobot' => rand(1, 10)
            ],
        ];

        foreach ($symptoms as $symptom) {
            Symptoms::create($symptom);
        }
        
        Diseases::reguard();
        foreach ($diseases as $disease) {
            $data = Diseases::create($disease);

            foreach($disease['gejala'] as $gejala) {
                // echo $gejala;
                CaseStudies::create([
                    'diseases_id' => $data->id,
                    'symptoms_id' => $gejala
                ]);
            }
        }
    }
}
