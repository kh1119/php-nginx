<div class="container">
<section class="block_area block_area_category">
	<div class="block_area-header block_area-header-tabs">
		<div class="bah-top">
			<div class="float-left bah-heading mr-3">
				<h1 class="cat-heading">Search Results <?=($title)?'"'.$title.'"':''?></h1>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<form class="filters" action="/filter/">
		<div class="filter dropdown"><button class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-folder-open"></i> Genre <span class="value" data-label-placement="true">All</span></button>
			<ul class="dropdown-menu genre lg c4">
				<?php
				foreach($genre as $v) {
					if($v['danhmuc_show']==1)
						echo '<li><input '.(in_array($v['danhmucid'],$filter['genre'])?'checked':'').' name="genre[]" type="checkbox" id="genre_'.$v['danhmucid'].'" value="'.$v['danhmucid'].'"><label for="genre_'.$v['danhmucid'].'">'.$v['danhmucten'].'</label></li>';
				}
				?>
			</ul>
		</div>
		<div class="filter dropdown"><button class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-clone"></i> Type <span class="value" data-label-placement="true">All</span></button>
			<ul class="dropdown-menu c1">
				<li><input <?=((!$filter['type'])?'checked':'')?> name="type" id="type_all" type="radio" value=""><label for="type_all">All</label></li>
				<li><input <?=(($filter['type']=='movie')?'checked':'')?> name="type" id="type_movie" type="radio" value="movie"><label for="type_movie">Movie</label></li>
				<li><input <?=(($filter['type']=='series')?'checked':'')?> name="type" id="type_series" type="radio" value="series"><label for="type_series">TV Shows</label></li>
				<li><input <?=(($filter['type']=='upcoming')?'checked':'')?> name="type" id="type_upcoming" type="radio" value="upcoming"><label for="type_upcoming">Upcoming</label></li>
			</ul>
		</div>
		<div class="filter dropdown"><button class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-globe-americas"></i> Country <span class="value" data-label-placement="true">All</span></button>
			<ul class="dropdown-menu lg c4">
				<?php
				foreach($country as $v) {
					if($v['quocgia_show']==1)
						echo '<li><input '.(in_array($v['quocgiaid'],$filter['country'])?'checked':'').' name="country[]" type="checkbox" id="country_'.$v['quocgiaid'].'" value="'.$v['quocgiaid'].'"><label for="country_'.$v['quocgiaid'].'">'.$v['quocgiaten'].'</label></li>';
				}
				?>
			</ul>
		</div>
		<div class="filter dropdown"><button class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-calendar-alt"></i> Year <span class="value" data-label-placement="true">All</span></button>
			<ul class="dropdown-menu md c3">
				<?php
				for($i=2001;$i<=date("Y");$i++) {
					$release	=	date("Y")-$i+2001;
					echo '<li><input '.(in_array($release,$filter['release'])?'checked':'').' name="release[]" type="checkbox" id="release_'.$release.'" value="'.$release.'"><label for="release_'.$release.'">'.$release.'</label></li>';
					unset($release);
				}
				?>
				<li><input <?=(in_array('2000s',$filter['release'])?'checked':'')?> name="release[]" type="checkbox" id="release_2000s" value="2000s"> <label for="release_2000s">2000s</label></li>
				<li><input <?=(in_array('1990s',$filter['release'])?'checked':'')?> name="release[]" type="checkbox" id="release_1990s" value="1990s"> <label for="release_1990s">1990s</label></li>
				<li><input <?=(in_array('1980s',$filter['release'])?'checked':'')?> name="release[]" type="checkbox" id="release_1980s" value="1980s"> <label for="release_1980s">1980s</label></li>
				<li><input <?=(in_array('1970s',$filter['release'])?'checked':'')?> name="release[]" type="checkbox" id="release_1970s" value="1970s"> <label for="release_1970s">1970s</label></li>
				<li><input <?=(in_array('1960s',$filter['release'])?'checked':'')?> name="release[]" type="checkbox" id="release_1960s" value="1960s"> <label for="release_1960s">1960s</label></li>
				<li><input <?=(in_array('1950s',$filter['release'])?'checked':'')?> name="release[]" type="checkbox" id="release_1950s" value="1950s"> <label for="release_1950s">1950s</label></li>
				<li><input <?=(in_array('1940s',$filter['release'])?'checked':'')?> name="release[]" type="checkbox" id="release_1940s" value="1940s"> <label for="release_1940s">1940s</label></li>
				<li><input <?=(in_array('1930s',$filter['release'])?'checked':'')?> name="release[]" type="checkbox" id="release_1930s" value="1930s"> <label for="release_1930s">1930s</label></li>
				<li><input <?=(in_array('1920s',$filter['release'])?'checked':'')?> name="release[]" type="checkbox" id="release_1920s" value="1920s"> <label for="release_1920s">1920s</label></li>
				<li><input <?=(in_array('1910s',$filter['release'])?'checked':'')?> name="release[]" type="checkbox" id="release_1910s" value="1910s"> <label for="release_1910s">1910s</label></li>
				<li><input <?=(in_array('1900s',$filter['release'])?'checked':'')?> name="release[]" type="checkbox" id="release_1900s" value="1900s"> <label for="release_1900s">1900s</label></li>
			</ul>
		</div>
		<div class="filter dropdown"> <button class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-cube"></i> Quality <span class="value" data-label-placement="true">All</span> </button>
			<ul class="dropdown-menu c1">
				<li><input <?=(in_array('HD',$filter['quality'])?'checked':'')?> name="quality[]" id="quality_HD" type="checkbox" value="HD"> <label for="quality_HD">HD</label></li>
				<li><input <?=(in_array('HDRip',$filter['quality'])?'checked':'')?> name="quality[]" id="quality_HDRip" type="checkbox" value="HDRip"> <label for="quality_HDRip">HDRip</label></li>
				<li><input <?=(in_array('SD',$filter['quality'])?'checked':'')?> name="quality[]" id="quality_SD" type="checkbox" value="SD"> <label for="quality_SD">SD</label></li>
				<li><input <?=(in_array('TS',$filter['quality'])?'checked':'')?> name="quality[]" id="quality_TS" type="checkbox" value="TS"> <label for="quality_TS">TS</label></li>
				<li><input <?=(in_array('CAM',$filter['quality'])?'checked':'')?> name="quality[]" id="quality_CAM" type="checkbox" value="CAM"> <label for="quality_CAM">CAM</label></li>
			</ul>
		</div>
		<div class="filter dropdown"><button class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-closed-captioning"></i> Subtitle <span class="value" data-label-placement="true">All</span></button>
			<ul class="dropdown-menu c1">
				<li><input <?=((!$filter['type'])?'checked':'')?> name="subtitle" id="type_2" type="radio" value=""> <label for="type_2">All</label></li>
				<li><input <?=(($filter['subtitle']=='1')?'checked':'')?> name="subtitle" id="type_1" type="radio" value="1"> <label for="type_1">Yes</label></li>
				<li><input <?=(($filter['subtitle']=='0')?'checked':'')?> name="subtitle" id="type_0" type="radio" value="0"> <label for="type_0">No</label></li>
			</ul>
		</div>
		<div class="filter dropdown"><button class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-sort"></i> Sort <span class="value" data-label-placement="true">Default</span></button>
			<ul class="dropdown-menu sort c1">
				<li><input name="sort" <?=((!$filter['sort'])?'checked':'')?> id="sort_default" type="radio" value="default" checked="checked"> <label for="sort_default">Default</label></li>
				<li><input name="sort" <?=(($filter['sort']=='post_date:desc')?'checked':'')?> id="sort_post_date:desc" type="radio" value="post_date:desc"> <label for="sort_post_date:desc">Recently Added</label></li>
				<li><input name="sort" <?=(($filter['sort']=='views:desc')?'checked':'')?> id="sort_views:desc" type="radio" value="views:desc"> <label for="sort_views:desc">Most Watched</label></li>
				<li><input name="sort" <?=(($filter['sort']=='title:asc')?'checked':'')?> id="sort_title:asc" type="radio" value="title:asc"> <label for="sort_title:asc">Name</label></li>
				<li><input name="sort" <?=(($filter['sort']=='imdb:desc')?'checked':'')?> id="sort_imdb:desc" type="radio" value="imdb:desc"> <label for="sort_imdb:desc">IMDb</label></li>
				<li><input name="sort" <?=(($filter['sort']=='year:desc')?'checked':'')?> id="sort_year:desc" type="radio" value="year:desc"> <label for="sort_year:desc">Release Date</label></li>
			</ul>
		</div>
		<div class="filter submit"><button type="submit" class="mdb-btn mdb-theme"><i class="fa fa-filter"></i> Filter</button></div>
	</form>
	<?php if($arr['data'][0]) {?>
	<div class="pre-pagination mt-5 mb-5"><?=$pages?></div>
	<div class="block_area-content block_area-list film_list film_list-grid"><div class="film_list-wrap"><?=movies($arr['data'][0])?></div></div>
	<div class="pre-pagination mt-5 mb-5"><?=$pages?></div>
	<?php }else { ?>
	<div class="notice">There are no movies that matched your query.</div>
	<?php } ?>
</section>
</div>