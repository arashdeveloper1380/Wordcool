<h2> لیست {{ $name }}</h2>
<br><br>

<table class="wp-list-table widefat fixed striped table-view-list">
    <thead>
        <tr>
            <td>#</td>
            <td>نام</td>
            <td>شماره</td>
            <td>مدریت</td>
        </tr>
    </thead>

    <tbody>
        @foreach ($sample as $key => $value)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->phone }}</td>
                <td>
                    <a href="{{ add_query_arg(['action' => 'edit', 'id' => $value->id]) }}">ویرایش</a> |
                    <a href="{{ add_query_arg(['action' => 'delete', 'id' => $value->id]) }}">حذف</a>
                </td>
            </tr>
        @endforeach

    </tbody>
</table>
