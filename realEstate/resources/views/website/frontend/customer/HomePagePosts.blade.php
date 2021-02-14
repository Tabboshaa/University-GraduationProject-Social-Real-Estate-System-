@extends('website.frontend.layouts.main')
@section('content')

<link href="{{asset('css/FrontEndCSS/CustomerHome.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/FrontEndCSS/TimeLine.css')}}" rel="stylesheet" type="text/css" />

<div id="content-wrapper">
    <div class="container-fluid">
        <div class="dashboard">
            @foreach($posts as $post)
                <table>                 
                    
                    <thead> 
                        @foreach($post_images[$post->Post_Id]  as $post_image)
                        <tr class="postinfo">
                            <th colspan="3">
                                <h4>
                                    <a href="{{url('/itemProfile/'.$post->Item_Id)}}">
                                        <img height="50" width="70" src="{{asset('FrontEnd/images/cover page/'.$post_image->File_Path)}}" alt=""> 
                                    </a>
                                    <a href="{{url('/itemProfile/'.$post->Item_Id)}}">
                                        {{ $post->Item_Name }}
                                    </a> 
                                    <p> {{ $post->created_at }}</p>
                                </h4>
                            </th>
                        </tr>
                        @endforeach
                    </thead>
                    
                    <tbody>
                        <tr class="postcontent">
                            <td colspan="3">
                                <p>
                                    {{$post->Post_Content}}
                                </p>
                            </td>
                        </tr>
                        <tr class="postfooter">
                            <td colspan="3">
                                <input type="submit" id="btun2" value="Rent">
                            </td>
                        </tr>
                    </tbody>
                </table>
            @endforeach  
        </div>
    </div>
</div>

@endsection