<tr>
    <td class="{{ is_null($data)? '': 'text-muted' }}">
        <div id="map" data-latitude="{{ $data['latitude'] }}" data-longitude="{{ $data['longitude'] }}" style="width: 100%; height: 300px"></div>
    </td>
</tr>