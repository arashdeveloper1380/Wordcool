@extends('layouts.master')

@section('content')
    <p style="text-align: center;">this is index blade page</p>

    <form action="{{ route('/save') }}" name="save" method="POST">
        @php csrf() @endphp
        <label for="name">First name:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="name">phone:</label><br>
        <input type="text" id="phone" name="phone"><br>
        <input type="submit" value="Submit">

    </form>
    <br><br>

    <table id="table">
        <tr>
            <th>نام</th>
            <th>موبایل</th>
            <th>عملیات</th>
        </tr>
        <tbody>
            @foreach ($samples as $value)
                <tr>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->phone }}</td>
                    <td>
                        <a href="{{ routeWithParam('/delete', $value->id) }}">حذف</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @php
        errors();
    @endphp

    @if (getSession('success'))
        <h3>{{ getSession('success') }} </h3>
    @endif

@endsection
