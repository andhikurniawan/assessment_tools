@component('mail::message')
# Halo, {{ $data['name']}}

Anda telah di rekomendasikan untuk mengikuti pelatihan **{{$data['training_name']}}**

Pelatihan ini dilaksanakan oleh **{{$data['training_host']}}**

Dimulai pada (TAHUN-BULAN-TANGGAL) : **{{$data['start_date']}}**

Selesai pada (TAHUN-BULAN-TANGGAL) : **{{$data['end_date']}}**

@if ($data['status'] == 'Opsional')
Silakan beri respon pada menu Training Recommendation.
@else
Pelatihan ini bersifat **Wajib**. Detail pelatihan terdapat pada menu Training Recommendation.
@endif


@component('mail::button', ['url' => $data['url']])
Klik disini untuk melihat daftar rekomendasi pelatihan Anda
@endcomponent

Terima Kasih, <br>
{{ config('app.name') }}
@endcomponent
