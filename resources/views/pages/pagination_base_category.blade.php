<?php $currentPage = $posts->currentPage() ?>
<?php $pagePrevious = $posts->currentPage()-1; ?>
<?php $pageNext = $posts->currentPage()+1; ?>
@if($currentPage == 1)
<a href="{{ url('/'.$category->id.'/'.str_slug($category->name).'?page='.$pagePrevious ) }}" class="btn_mange_pagging disablePage"><i class="fa fa-long-arrow-left"></i>&nbsp;&nbsp; Previous</a>
@else
<a href="{{ url('/'.$category->id.'/'.str_slug($category->name).'?page='.$pagePrevious ) }}" class="btn_mange_pagging"><i class="fa fa-long-arrow-left"></i>&nbsp;&nbsp; Previous</a>
@endif
<?php $page=1; ?>
@while($numberPage >= $page)
    @if( $page >= $currentPage-2 && $page <= $currentPage+2 )
        @if ( $page == $currentPage)
    <a  href="{{ url('/'.$category->id.'/'.str_slug($category->name).'?page='.$page ) }}" class="btn_pagging currentPage">{{ $page }}</a>
        @else
    <a  href="{{ url('/'.$category->id.'/'.str_slug($category->name).'?page='.$page ) }}" class="btn_pagging">{{ $page }}
    </a>
        @endif
    @endif
    <?php $page +=1; ?>
@endwhile
@if($currentPage == $numberPage || $numberPage == 0)
<a href="{{ url('/'.$category->id.'/'.str_slug($category->name).'?page='.$pageNext ) }}" class="btn_mange_pagging disablePage">Next <i class="fa fa-long-arrow-right"></i>&nbsp;&nbsp; </a>
@else 
<a href="{{ url('/'.$category->id.'/'.str_slug($category->name).'?page='.$pageNext ) }}" class="btn_mange_pagging">Next <i class="fa fa-long-arrow-right"></i>&nbsp;&nbsp; </a>
@endif