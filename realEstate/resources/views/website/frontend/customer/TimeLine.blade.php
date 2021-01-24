@extends('website.frontend.layouts.main')
@section('content')

<link href="{{asset('css/FrontEndCSS/TimeLine.css')}}" rel="stylesheet" type="text/css" />
{{-- Posts --}}
<table>
    <thead>
        <tr class="postinfo">
            <th colspan="3">
                <h4>
                    <img src="Images/d.jpg" class="itemimg"/> 
                    Flat 4<p>23/1/2021</p>
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
        <tr class="postfooter"  >
            
            <td colspan="3">
                <input type="submit" id="btun2" value="Regester">
            </td>
        </tr>
        
    </tbody>
    </form>				
    <div class="clearfix"></div>
</table>    
    

@endsection