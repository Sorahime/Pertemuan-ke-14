<!DOCTYPE html>
<html>
    <head>
        <title>Daftar Barang LabLoan</title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    
    <body>
        <div class="container">
            <h2>Daftar Barang</h2>

            @if(session('success'))
                <p class="success">{{ session('success') }}</p>
            @endif

            <table border="1" cellpadding="10" width="100%">
                <tr>
                    <th>Nama Barang</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>

                @foreach($items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->stock }}</td>
                    <td>
                        <form method="POST" action="{{ route('borrow',$item->id) }}">
                            @csrf
                            <button type="submit">Pinjam</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
            <br>
            <a href="{{ route('loans.index') }}">Lihat Pinjaman Saya</a>
        </div>
    </body>
</html>
