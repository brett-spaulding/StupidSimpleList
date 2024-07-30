<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Stupid Simple List</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('/img/icon.jpg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    <!-- Icons -->
    <link href="{{ asset('/icons/boxicons-2.1.4/css/boxicons.css') }}" rel="stylesheet"/>

    <!-- Styles -->
    <link href="{{ asset('/css/normalize.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/css/skeleton.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/css/utils.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet"/>

</head>
<body data-csrf='{{ csrf_token() }}'>
<div class="wrapper">
    <div class="container mt-8">
        <div class="row">
            <div class="twelve columns">

                <form method="post" action="{{ route('removeCompleted') }}" accept-charset="UTF-8" class="float-right">
                    {{ csrf_field() }}
                    <button type="submit">Remove Completed</button>
                </form>

                <h1 class="">
                    <img src=" {{ asset('/img/icon.jpg') }}" height="60px" width="auto"/>
                    Stupid Simple List
                </h1>
                <form method="post" action="{{ route('saveItem') }}" accept-charset="UTF-8">
                    {{ csrf_field() }}
                    <input type="text" name="listItem" class="u-full-width" placeholder="Enter New Item.." autofocus>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="twelve columns">
                <table class="u-full-width">
                    <thead>
                    <tr>
                        <th>Items</th>
                        <th class="text-right"></th>
                    </tr>
                    </thead>
                    <tbody>

                    @if(count($listItems) > 0)
                        @foreach($listItems as $listItem)
                            <tr>
                                <td @class(['strikethrough' => $listItem->is_completed == 1])
                                >{{ $listItem->name }}</td>
                                <td class="text-right">
                                <span>
                                    <button hx-post="{{ route('toggleCompleted', $listItem->id) }}"
                                            hx-headers='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}'
                                        @class([
                                        'bg-warning' => $listItem->is_completed == 0,
                                        'bg-success' => ! $listItem->is_completed == 0,
                                        'button-icon',
                                        ])>
                                        <i @class([
                                            "bx",
                                            "bx-check" => $listItem->is_completed == 0,
                                            "bx-check-double" => ! $listItem->is_completed == 0,
                                            "center",
                                            ])></i>
                                    </button>

                                    <button hx-post="{{ route('deleteItem', $listItem->id) }}"
                                            hx-headers='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}'
                                            hx-confirm="Are you sure you wish to delete {{ $listItem->name }}?"
                                            class="bg-danger button-icon"
                                    >
                                        <i class="bx bx-trash center"></i>
                                    </button>
                                </span>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>List empty, add new items above!</td>
                            <td></td>
                        </tr>
                    @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<footer>
    &copy; 2024 Brett Spaulding
</footer>

<!-- Scripts -->
<script defer src="{{ asset('/js/alpine.min.js') }}"></script>
<script src="{{ asset('/js/htmx.min.js') }}"></script>
<script src="{{ asset('/js/jquery.min.js') }}"></script>
<script src="{{ asset('/js/app.js') }}"></script>
</body>
</html>
