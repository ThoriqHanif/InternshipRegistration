<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Intern Status Update</title>
    
</head>
<body>
    <p>Terimakasih telah mendaftar Magang di Kadang Koding Indonesia, dan berikut kami lampirkan untuk Status Pendaftaran Anda</p>
    @if ($newStatus === 'diterima')
        <p>Selamat {{ $data->full_name }}, pendaftaran magang Anda di Kadang Koding Indonesia <strong class="text-success" style="color: green">{{ $newStatus }}</strong> </p>
    @elseif ($newStatus === 'ditolak')
        <p>Mohon maaf {{ $data->full_name }}, pendaftaran magang Anda di Kadang Koding Indonesia <strong class="text-danger" style="color: red">{{ $newStatus }}</strong> </p>
    @endif
    <p>Berikut adalah detail pendaftaran Anda:</p>
    <ul>
        <li>Nama: {{ $data->full_name }}</li>
        <li>Sekolah: {{ $data->school }}</li>
        <li>Jurusan: {{ $data->major }}</li>
        <li>Posisi Magang: {{ $data->position->name }}</li>
        <li>Tanggal Mulai: {{ $data->start_date }}</li>
        <li>Tanggal Selesai: {{ $data->end_date }}</li>
        <li>Status: {{ $newStatus }}</li>
    </ul>
    @if ($newStatus === 'diterima')
    <p>Berikut adalah detail akun untuk login:</p>
    <ul>
        <li>Email: {{ $data->user->email }}</li>
        <li>Password: {{ $password }}</li>
    </ul>
@endif
    <p>Terima kasih atas pendaftaran Anda.</p>
</body>
</html>
