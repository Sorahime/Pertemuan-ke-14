<!DOCTYPE html>
<html>
    <head>
        <title>Pinjaman Saya - LabLoan</title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>

    <body>
        <div class="container">
            <h2>Pinjaman Saya</h2>

            @if(session('success'))
                <p class="success">{{ session('success') }}</p>
            @endif

            <table border="1" cellpadding="10" width="100%">
                <tr>
                    <th>Barang</th>
                    <th>Status</th>
                    <th>Tgl Pinjam</th>
                    <th>Aksi</th>
                </tr>

                @foreach($loans as $loan)
                <tr>
                    <td>{{ $loan->item->name }}</td>
                    <td>{{ $loan->status }}</td>
                    <td>{{ $loan->loan_date }}</td>

                    <td>
                        @if($loan->status == 'borrowed')
                        <form method="POST" action="{{ route('return',$loan->id) }}">
                            @csrf
                            <button type="submit">Kembalikan</button>
                        </form>
                        @else
                            Sudah dikembalikan
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
            <br>
            <a href="{{ route('items.index') }}">Kembali ke Daftar Barang</a>
        </div>
    </body>
</html>
