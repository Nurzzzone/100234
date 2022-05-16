<tr>
    <td>
        {{ Form::hidden('latitude', $latitude, ['id' => 'input-latitude']) }}
        {{ Form::hidden('longitude', $longitude, ['id' => 'input-longitude']) }}
        <div id="map" style="width: 100%; height: 300px"></div>
    </td>
</tr>