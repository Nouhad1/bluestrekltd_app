<!DOCTYPE html>
<html lang="fr">
<head>
    @include('admin.css')
    <style>
        .reference_deg {
            text-align: center;
            font-size: 40px;
            padding-bottom: 40px;
        }
        .table_deg {
            border: 2px solid #2810db;
            width: 100%;
            margin: auto;
            padding-top: 50px;
            text-align: center;
        }
        .img_size {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
        .th_color {
            background: #1119ec;
            color: white;
        }
        td {
            border: 2px solid #1e14e3;
        }
    </style>
</head>
<body>
<div class="container-scroller">
    @include('admin.sidebar')
    @include('admin.header')

    <div class="main-panel">
        <div class="content-wrapper">

            <h2 class="reference_deg">Tous les messages</h2>
            <table class="table_deg">
    <thead>
        <tr class="th_color">
            <th>Nom</th>
            <th>Email</th>
            <th>Sujet</th>
            <th>Message</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($messages as $msg)
        <tr>
            <td>{{ $msg->name }}</td>
            <td>{{ $msg->email }}</td>
            <td>{{ $msg->subject }}</td>
            <td>{{ $msg->message }}</td>
            <td>{{ $msg->created_at }}</td>
            <td><a href="{{ route('admin.reply', ['id' => $msg->id]) }}">Répondre</a></td>
        </tr>
        @endforeach
    </tbody>
</table>


        </div>
    </div>         
</div>

@include('admin.script')
</body>
</html>
