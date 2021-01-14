<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

</head>

<body class="bg-light">
    <div class="container">
        <div class="card my-5">
            <div class="card-body">
                <div style="display: block;
                margin-left: auto;
                margin-right: auto;
                width: 50%;">
                    <img src="https://lh3.googleusercontent.com/hP9Y-BA4ZIFv97qDgj2qqYtxvbsSp1rwfxb9LNlqM61KFn8OGjYvw61MQZtdMV9-I6fPkBc6QPxBLehPcyLow0NjJvrebrWqIxKRtJSmEREBmfHHOoZEUVnVa4QrJXqXc6c8eqgeIgzvMQ9E3cKDbiBeMdALSnW4wBkeabdszMzmW3uqHNyULv-4C__SHgZfqkDU1dKbtBL9DaxjrLBa1WZogsXBkfspOCeObReHe0VtVW6uzYes-6j4jJkFWs0g2uQsZXsemW6z2YAJUtna9pAgBajNke8AHpYAXWh6MUPAVY3YByd8xEnBc60nEFcWE_ZHbiL6fec2F7CnOsfRNixfqZHbDJXYtrC3BSEIrrYcrCeeoodU-csETWV57Z7SZ_vKvKLrX953D_QW6MJ3Ps2mT-QZmkaruakuCB6jvdYSfufxAvLA110Qq5Oo1HAJCGEgHnfeFgohs_RqtZtu5poDf1darW3FmIT7hElbczk2iwRy1LesWL5qv8AY72lSmNp-qzrGXGwIh7LpIGv_6Oq6U9pZS1-dNH-eq36i3Bo4-l8mBE2EKEYQmYXp1uecExz-MaQ75cXcVGkp7waSLqACPeA-u6hzqfGkvyYvo4OtFnnoBXRoyt3RrY6jdo83dLMDUvhzTwaWZq5BhA2XYdr6uNo1GelZgZ65h_xuY_iOQ4OZuEOC4gSJxAKV=s636-no?authuser=6"
                        class="text-center" style="height: 100px; width: 100px" alt="web assessment logo">
                </div>
                <h1 style="text-align: center">Bubat Web Assessment</h1>
                <h3>Halo, {{ $name }}</h3>
                <p>Admin telah menentukan periode memasukan data Track Record. Data yang dimasukan adalah riwayat Anda dalam mengikuti pelatihan atau sertifikasi dan dalam melaksanakan project.
                </p>
                <p>Periode Dimulai pada (TAHUN-BULAN-TANGGAL) : <b id="startDate">{{ $start_date }}</b></p>
                <p>Periode Diakhiri pada (TAHUN-BULAN-TANGGAL) :<b id="endDate">{{ $end_date }}</b></p>

                <p>Terima kasih.</p>
                <br>
                <div style="text-align: center">
                    <a style="  color: #fff;
                    background-color: #4e73df;
                    border-color: #4e73df; text-align: center;
                    " href="{{ url('/track-record') }}">Klik disini untuk mengakses menu Track Record</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
    <script>
        jQuery(document).ready(function() {
            var start_date = "{{ $start_date }}";
            var end_date = "{{ $end_date }}";
            var options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            var dateStart = new Date(start_date);
            var dateEnd = new Date(end_date);
            var longStartDate = dateStart.toLocaleDateString("id-ID", options);
            var longEndDate = dateEnd.toLocaleDateString("id-ID", options);
            $('#startDate').text(longStartDate);
            $('#endDate').text(longEndDate);


        });

    </script>
</body>

</html>
