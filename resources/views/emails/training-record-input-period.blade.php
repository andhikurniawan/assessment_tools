@component('mail::message')
# Halo, {{ $tr_input_data['name']}}

Admin telah menentukan periode memasukan data Track Record. Data yang dimasukan adalah riwayat Anda dalam mengikuti pelatihan atau sertifikasi dan dalam melaksanakan project.

Periode Dimulai pada (TAHUN-BULAN-TANGGAL) : **{{$tr_input_data['start_date']}}**

Periode Diakhiri pada (TAHUN-BULAN-TANGGAL) : **{{$tr_input_data['end_date']}}**

@component('mail::button', ['url' => $data['url']])
Klik disini untuk mengakses menu Track Record
@endcomponent

Terima Kasih, <br>
Admin
@endcomponent
