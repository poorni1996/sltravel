@extends('admin.layouts.default')

@section('title', 'Create Hotel')
@section('style')
<link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">Details</h3>

    </div>

    <form method="POST" action="{{ route('hotels.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">

            <div class="row">
                <div class="col-md-4">

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" name="description" value="{{ old('description') }}">
                        @error('description')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="address" class="form-control" id="address" rows="1"></textarea>
                        @error('address')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Price per Adult</label>
                        <input type="text" class="form-control" name="price" value="{{ old('price') }}">
                        @error('price')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Price per Child</label>
                        <input type="text" class="form-control" name="price_child" value="{{ old('price_child') }}">
                        @error('price_child')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <small><i>(Under 18 years old considered as a child)</i></small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>City</label>
                        <select class="form-control select2bs4" id="city_id" name="city_id">
                            <option value="">Select</option>
                            @foreach ($cities as $city)
                            <option value="{{ $city->id }}" data-lat="{{ $city->latitude }}"
                                data-lng="{{ $city->longitude }}">{{ $city->city_name }}</option>
                            @endforeach
                        </select>
                        @error('city_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">

                    <div class="form-group">
                        <label>Telephone</label>
                        <input type="text" class="form-control" name="telephone" value="{{ old('telephone') }}">
                        @error('telephone')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <input type="hidden" name="latitude" id="loca_lat" value="{{ old('latitude', '7.8731') }}">
                    <input type="hidden" name="longitude" id="loca_lng" value="{{ old('longitude', '80.7718') }}">
                    <div style="width: 100%;height: 500px;" id="mapContainer"></div>
                </div>
                <div class="col-md-12">

                    <div class="form-group">
                        <label>Hotel Features</label>
                        <div class="row">

                            @foreach ($hotel_features as $hotel_feature)
                            <div class="col-md-3">
                                <input type="checkbox" name="feature[{{ $hotel_feature->id }}]"
                                    id="feature_{{ $hotel_feature->id }}" value="1">
                                <label for="feature_{{ $hotel_feature->id }}">{{ $hotel_feature->desc }}</label>
                            </div>
                            @endforeach
                        </div>
                        @error('feature.*')
                        <small class="text-danger">Needs to contain at least one feature</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">

                <div class="row">
                    <div class="col">
                        <label for="">Galery Images</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mt-2">
                        <input type="file" class="form-control" name="gallery_images[]">
                    </div>
                    <div class="col-md-4 mt-2">
                        <input type="file" class="form-control" name="gallery_images[]">
                    </div>
                    <div class="col-md-4 mt-2">
                        <input type="file" class="form-control" name="gallery_images[]">
                    </div>
                    <div class="col-md-4 mt-2">
                        <input type="file" class="form-control" name="gallery_images[]">
                    </div>
                    <div class="col-md-4 mt-2">
                        <input type="file" class="form-control" name="gallery_images[]">
                    </div>
                </div>
            </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="row">
                <div class="col-sm-6">
                    <a href="{{ route('employee') }}" class="btn btn-info"> Back </a>
                </div>
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary float-right"> Submit </button>
                </div>
            </div>
        </div>
    </form>
    <!-- /.card-footer-->
</div>
<!-- /.card -->


<!-- /.card -->

@endsection
@section('script')
<link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
<script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
<script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
<script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
<script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    // update current selected lat long to hidden fields
    function curLoca(lat_lng) {
        // console.log(lat_lng);
        $("#loca_lat").val(lat_lng.lat);
        $("#loca_lng").val(lat_lng.lng);
    }
    var start_loca = { lat: $("#loca_lat").val(), lng:  $("#loca_lng").val()}
    //Step 1: initialize communication with the platform
    // apikey = here-Maps API key
    var platform = new H.service.Platform({
        apikey: 'lwwn_elbW7nc0P3BiRaX0XMIJzdzLhxYb-nlXc0dSgw'
    });
    var defaultLayers = platform.createDefaultLayers();
    //Step 2: initialize a map - this map is centered over Sri Lanka for default
    var start_zoom = 7;
    if (start_loca.lat != 7.8731) {
        start_zoom = 11;
    }
    var map = new H.Map(document.getElementById('mapContainer'),
        defaultLayers.vector.normal.map,
        {
            center: start_loca,
            zoom: start_zoom,
            pixelRatio: window.devicePixelRatio || 1
        }
    );
    // This adds a resize listener to make sure that the map occupies the whole container
    window.addEventListener('resize', () => map.getViewPort().resize());
    //Step 3: make the map interactive
    // MapEvents enables the event system
    // Behavior implements default interactions for pan/zoom (also on mobile touch environments)
    var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
    // disable zoom on scroll
    // behavior.disable(H.mapevents.Behavior.WHEELZOOM);
    // Create the default UI components
    var ui = H.ui.UI.createDefault(map, defaultLayers);


    var marker = new H.map.Marker(start_loca, {
        // mark the object as volatile for the smooth dragging
        volatility: true
    });
    // Ensure that the marker can receive drag events
    marker.draggable = true;
    map.addObject(marker);

    // update current location to started location
    curLoca(start_loca);

    // move marker to location that user clicks
    map.addEventListener('tap', function (evt) {
        var coord = map.screenToGeo(evt.currentPointer.viewportX,
            evt.currentPointer.viewportY);
        let curLoc = { lat: coord.lat, lng: coord.lng };
        marker.setGeometry(curLoc);
        curLoca(curLoc);
    });

    // disable the default draggability of the underlying map
    // and calculate the offset between mouse and target's position
    // when starting to drag a marker object:
    map.addEventListener('dragstart', function (ev) {
        var target = ev.target,
            pointer = ev.currentPointer;
        if (target instanceof H.map.Marker) {
            var targetPosition = map.geoToScreen(target.getGeometry());
            target['offset'] = new H.math.Point(pointer.viewportX - targetPosition.x, pointer.viewportY - targetPosition.y);
            behavior.disable();
        }
    }, false);


    // re-enable the default draggability of the underlying map
    // when dragging has completed
    map.addEventListener('dragend', function (ev) {
        var target = ev.target;
        if (target instanceof H.map.Marker) {
            behavior.enable();
            curLoca(target.getGeometry());
        }
    }, false);

    // Listen to the drag event and move the position of the marker as necessary
    map.addEventListener('drag', function (ev) {
        var target = ev.target,
            pointer = ev.currentPointer;
        if (target instanceof H.map.Marker) {
            target.setGeometry(map.screenToGeo(pointer.viewportX - target['offset'].x, pointer.viewportY - target['offset'].y));
        }
    }, false);

    // move marker to location of the selected city
    $('#city_id').on('change', function(){
        let lat = $(this).find("option:selected").data('lat');
        let lng = $(this).find("option:selected").data('lng');
        let curLoc = { lat: lat, lng: lng };
        map.setCenter(curLoc);
        map.setZoom(11);
        marker.setGeometry(curLoc);
        curLoca(curLoc);
    });

    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
</script>
@endsection