<h3>Market Opportunites:</h3>

<ul>
@foreach ($email_data as $row)
<li>
	<b>{!! $row['pair'] . ' ' . $row['type'] !!}</b>
	<br />
	{!! $row['message'] !!}
</li>
@endforeach
</ul>