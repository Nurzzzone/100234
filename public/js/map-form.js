$(document).ready(function() {
    var map;
    const lat = $('#input-latitude')
    const lng = $('#input-longitude')

    ymaps.ready(init);

    function init () {
        map = new ymaps.Map('map', {
            center: [lat.val(), lng.val()],
            zoom: 15,
            controls: ['searchControl'],
        }, {
            searchControlProvider: 'yandex#search'
        });

        let mark = new ymaps.Placemark([lat.val(), lng.val()], {
        }, {
            preset: 'islands#dotIcon',
            iconColor: '#17488B'
        });

        map.geoObjects.add(mark)

        map.events.add('click', function(e) {
            let coords = e.get('coords')
            mark.geometry.setCoordinates(coords)

            lat.val(coords[0])
            lng.val(coords[1])
        })
    }
});