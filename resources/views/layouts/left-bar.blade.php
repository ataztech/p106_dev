

<style>

    .left_sec ul li{

    font-size: 17px;

    }

    </style>

<div class="left_sec content" style="background-image: linear-gradient(to bottom,#4b61b7 0%, #09203f 100%);">

      <ul class="nav">

          <li style="cursor: pointer" onclick="window.location='{{url('dashboard')}}'"><h4>Dashboard</h4></li>

          <li>

            <a href="{{url('user/syllabus')}}">Class: {{Auth::user()->ConfigureSyllabus->class}}</a>

        </li>

      </ul>

      <ul class="nav">

        <li><h4>Learn</h4></li>

      @if(isset(Auth::user()->ConfigureSyllabus->standard->subjects))
      
      
  @foreach(Auth::user()->ConfigureSyllabus->standard->subjects as $subject)

        @if(Auth::user()->mobile=='9822982298' && $subject->name=="Biology")
        
        @else
        <li><a href="{{url('user/learn/'.base64_encode($subject->id))}}"><i class="fa fa-cubes" aria-hidden="true"></i>{{$subject->name}}</a></li>
        @endif
        @endforeach
   
   @else
   

      <script>
          window.location = '{{url("user/configure/class")}}'
      </script>
        
       
        
        @endphp
        @endif
      </ul>

      <ul class="nav">

        <li>

            <h4>Tools</h4>

        </li>

        <li>

            <a href="{{url('tools/tests/all')}}"><i class="fa fa-cubes" aria-hidden="true"></i>Tests</a>

        </li>

        <li>

            <a href="{{url('tools/bookmarks')}}"><i class="fa fa-bookmark" aria-hidden="true"></i>Bookmarks</a>

        </li>

      </ul>

      

      <ul class="nav">

        <li>

            <h4>Settings</h4>

        </li>

        <li>

            <a href="{{url('user/syllabus')}}"><i class="fa fa-cubes" aria-hidden="true"></i>My Syllabus</a>

        </li>

      </ul>

      <ul class="nav">

     

        <li>

            <a href="{{url('logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i>Log Out</a>

        </li>

      </ul>

 </div>

