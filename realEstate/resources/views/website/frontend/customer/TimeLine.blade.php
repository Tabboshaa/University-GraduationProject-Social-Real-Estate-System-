@extends('website.frontend.layouts.main')
@section('content')
<div class="row">
    <div class="container-fluid">
        <div class="dashboard">
            <link href="{{asset('css/FrontEndCSS/TimeLine.css')}}" rel="stylesheet" type="text/css" />
            {{-- Posts --}}
            @foreach($items as $item)
            <a href="{{url('/itemProfile/'.$item->Item_Id)}}">
                <table>
                    <thead>
                        <tr class="postinfo">
                            <th colspan="3">
                                <h4>
                                    <img height="50" width="70" src="{{asset('FrontEnd/images/coverpage/'.$item->path)}}" alt="">
                                    {{ $item->Item_Name }}
                                    <p> {{ $item->created_at }}</p>
                                </h4>
                            </th>

                        </tr>
                    </thead>

                    <form>
                        <tbody>
                            <tr class="postcontent">
                                <td colspan="3">
                                    <p>
                                        This paragraph contains a lot of lines in the source code, but the browser ignores it.
                                        This paragraph contains a lot of spaces in the source code, but the browser ignores it.
                                        The number of lines in a paragraph depends on the size of the browser window. If you
                                        resize the browser window, the number of lines in this paragraph will change.
                                    </p>
                                </td>
                            </tr>
                            <tr class="postfooter">

                                <td colspan="3">
                                    <input type="submit" id="btun2" value="Rent">
                                </td>
                            </tr>

                        </tbody>
                    </form>
                    <div class="clearfix"></div>
                </table>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
