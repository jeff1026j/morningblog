<?php
// Loads the rating engine!
$ratings = new gonzo_user_rating();
get_header();
// Start the loop
if (have_posts()) : while (have_posts()) : the_post();
    $format = get_post_format();
    if (false === $format) $format = 'standard';
    $category = get_the_category();

// Get the current page url for FB comments
$url = (!empty($_SERVER['HTTPS'])) ? "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] : "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
?>

<section id="omc-main">	

	<article id="omc-full-article" class="omc-inner-<?php echo $format;?>">
		
		<?php
    //Get the comments option
    $omc_comment_type = get_post_meta(get_the_ID(), 'omc_comment_type', true);

    //Get the video meta data
    $omc_is_video = get_post_meta(get_the_ID(), 'omc_is_video', true);
    $omc_video_encode = get_post_meta(get_the_ID(), 'omc_video_encode', true);

    //Bring in the ratings data
    $omc_review_enable = get_post_meta(get_the_ID(), 'omc_review_enable', true);
    $omc_user_ratings_visibility = get_post_meta(get_the_ID(), 'omc_user_ratings_visibility', true);
    $omc_final_score = get_post_meta(get_the_ID(), 'omc_final_score', true);
    $omc_longer_summary = get_post_meta(get_the_ID(), 'omc_longer_summary', true);
    $omc_brief_summary = get_post_meta(get_the_ID(), 'omc_brief_summary', true);
    $omc_review_type = get_post_meta(get_the_ID(), 'omc_review_type', true);
    $omc_criteria_display = get_post_meta(get_the_ID(), 'omc_criteria_display', true);
    $omc_criteria_header = get_post_meta(get_the_ID(), 'omc_criteria_header', true);
    $omc_c1_rating = get_post_meta(get_the_ID(), 'omc_c1_rating', true);
    $omc_c1_description = get_post_meta(get_the_ID(), 'omc_c1_description', true);
    $omc_c2_rating = get_post_meta(get_the_ID(), 'omc_c2_rating', true);
    $omc_c2_description = get_post_meta(get_the_ID(), 'omc_c2_description', true);
    $omc_c3_rating = get_post_meta(get_the_ID(), 'omc_c3_rating', true);
    $omc_c3_description = get_post_meta(get_the_ID(), 'omc_c3_description', true);
    $omc_c4_rating = get_post_meta(get_the_ID(), 'omc_c4_rating', true);
    $omc_c4_description = get_post_meta(get_the_ID(), 'omc_c4_description', true);
    $omc_c5_rating = get_post_meta(get_the_ID(), 'omc_c5_rating', true);
    $omc_c5_description = get_post_meta(get_the_ID(), 'omc_c5_description', true);
    $omc_c6_rating = get_post_meta(get_the_ID(), 'omc_c6_rating', true);
    $omc_c6_description = get_post_meta(get_the_ID(), 'omc_c6_description', true);

    // Calculate the percentages from the star ratings
    $omc_c1_percentage = $omc_c1_rating * 20;
    $omc_c2_percentage = $omc_c2_rating * 20;
    $omc_c3_percentage = $omc_c3_rating * 20;
    $omc_c4_percentage = $omc_c4_rating * 20;
    $omc_c5_percentage = $omc_c5_rating * 20;
    $omc_c6_percentage = $omc_c6_rating * 20;
    $omc_final_percentage = $omc_final_score * 20;

    // Setup new variable to echo out the sprite width
    $omc_c1_width = $omc_c1_percentage + 2;
    $omc_c2_width = $omc_c2_percentage + 2;
    $omc_c3_width = $omc_c3_percentage + 2;
    $omc_c4_width = $omc_c4_percentage + 2;
    $omc_c5_width = $omc_c5_percentage + 2;
    $omc_c6_width = $omc_c6_percentage + 2;
    $omc_final_width = $omc_final_percentage + 2;

    $format = get_post_format();
    if (false === $format)
        $format = 'standard';
    ?>

    <?php if ($format == 'gallery') { ?>

    <p class="omc-date-time-gallery"><b><?php _e('', 'gonzo'); ?></b> <?php the_time('F jS, Y') ?> |
        <em><?php _e('', 'gonzo'); ?> <?php the_author() ?></em></p>

        <?php } elseif ($format == 'video') { ?>

    <div class="omc-main-video">

        <?php echo($omc_video_encode);?>

    </div>

    <p class="omc-date-time-video"><b><?php _e('', 'gonzo'); ?></b> <?php the_time('F jS, Y') ?> |
        <em><?php _e('', 'gonzo'); ?> <?php the_author() ?></em></p>

        <?php } else { ?>

    <div id="omc-inner-placeholder">

        <?php if ($category[0]) {
        echo '<a href="' . get_category_link($category[0]->term_id) . '" class="omc-flex-category">' . $category[0]->cat_name . '</a>';
    } ?>
        <?php if (has_post_thumbnail()) { ?>

        <?php the_post_thumbnail('featured-image', array('class' => 'featured-full-width-top')); ?>

        <?php
    } else {

        echo('<img src="' . get_template_directory_uri() . '/images/no-image-featured-image.png" class="omc-image-resize" alt="no image" />');

    } ?>

        <div class="omc-article-top">

            
            <span class="omc-comment-count"><fb:comments-count href=<?php echo $url; ?>></fb:comments-count></span>
            
        </div>
        <!-- /omc-article-top-->

    </div><!-- /omc-inner-placeholder -->

        <?php } ?>

<h1 class="omc-post-heading-<?php echo $format;?>"><?php the_title();?></h1>

<div style="float:left;" class="g-plusone" data-size="tall" href="<?php the_permalink(); ?>"></div>

<div style="margin-bottom: 30px; margin-left: 10px;" class="fb-like" data-href="<?php echo $url; ?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div><br/>

<!--<a href="http://www.morningshop.tw/edm/201502A13000001?utm_source=official-blog&utm_medium=A1_Banner&utm_content=2015213-過年優惠活動&utm_campaign=2015-Feb-Campaign健康過好年活動"><img src="http://i.imgur.com/Ilb5d2C.png?1" class="alignnone size-full wp-image-557"/></a><br/><br/>-->

    <?php if ($omc_criteria_display == 'b' || $omc_criteria_display == 'n' || $omc_criteria_display == '') {
        the_content();
    } ?>

    <?php if ($omc_criteria_display !== 'n') { ?>

        <?php if ($omc_review_enable == 1) { ?>

        <div itemscope itemtype="http://data-vocabulary.org/Review" id="omc-review-wrapper" class="omc-review-placement-<?php echo($omc_criteria_display); ?>">
        	
        	<span style="display:none" itemprop="itemreviewed"><?php the_title();?></span>
        	
        	<span style="display:none" itemprop="reviewer"><?php the_author(); ?></span>
        		
            <?php if ($omc_criteria_header !== '') { ?>

            <div id="omc-review-header">
                <h2><?php echo $omc_criteria_header; ?></h2>
            </div><!-- /omc-review-header -->

            <?php } ?>

            <?php if ($omc_review_type == 'percent') { ?>

            <?php if ($omc_c1_rating !== '') { ?>
                <div class="omc-review-criteria omc-criteria-percent">
                    <span class="omc-criteria-percentage" style="width:<?php echo $omc_c1_percentage; ?>%"></span>
                    <span class="omc-criteria-description"><?php echo $omc_c1_description; ?>
                        - <?php echo $omc_c1_percentage; ?>%</span>
                </div><!-- /criteria -->
                <?php } ?>

            <?php if ($omc_c2_rating !== '') { ?>
                <div class="omc-review-criteria omc-criteria-percent">
                    <span class="omc-criteria-percentage" style="width:<?php echo $omc_c2_percentage; ?>%"></span>
                    <span class="omc-criteria-description"><?php echo $omc_c2_description; ?>
                        - <?php echo $omc_c2_percentage; ?>%</span>
                </div><!-- /criteria -->
                <?php } ?>

            <?php if ($omc_c3_rating !== '') { ?>
                <div class="omc-review-criteria omc-criteria-percent">
                    <span class="omc-criteria-percentage" style="width:<?php echo $omc_c3_percentage; ?>%"></span>
                    <span class="omc-criteria-description"><?php echo $omc_c3_description; ?>
                        - <?php echo $omc_c3_percentage; ?>%</span>
                </div><!-- /criteria -->
                <?php } ?>

            <?php if ($omc_c4_rating !== '') { ?>
                <div class="omc-review-criteria omc-criteria-percent">
                    <span class="omc-criteria-percentage" style="width:<?php echo $omc_c4_percentage; ?>%"></span>
                    <span class="omc-criteria-description"><?php echo $omc_c4_description; ?>
                        - <?php echo $omc_c4_percentage; ?>%</span>
                </div><!-- /criteria -->
                <?php } ?>

            <?php if ($omc_c5_rating !== '') { ?>
                <div class="omc-review-criteria omc-criteria-percent">
                    <span class="omc-criteria-percentage" style="width:<?php echo $omc_c5_percentage; ?>%"></span>
                    <span class="omc-criteria-description"><?php echo $omc_c5_description; ?>
                        - <?php echo $omc_c5_percentage; ?>%</span>
                </div><!-- /criteria -->
                <?php } ?>

            <?php if ($omc_c6_rating !== '') { ?>
                <div class="omc-review-criteria omc-criteria-percent">
                    <span class="omc-criteria-percentage" style="width:<?php echo $omc_c6_percentage; ?>%"></span>
                    <span class="omc-criteria-description"><?php echo $omc_c6_description; ?>
                        - <?php echo $omc_c6_percentage; ?>%</span>
                </div><!-- /criteria -->
                <?php } ?>

            <?php } else { //START THE STAR LOOP /////////////////////////////////////////// ?>

            <?php if ($omc_c1_rating !== '') { ?>
                <div class="omc-review-criteria omc-criteria-star">
                    <span class="omc-criteria-star-under"><span class="omc-criteria-star-top"
                                                                style="width:<?php echo $omc_c1_width;?>%"></span></span>
                    <span class="omc-criteria-description"><?php echo $omc_c1_description; ?></span>
                </div><!-- /criteria -->
                <?php } ?>

            <?php if ($omc_c2_rating !== '') { ?>
                <div class="omc-review-criteria omc-criteria-star">
                    <span class="omc-criteria-star-under"><span class="omc-criteria-star-top"
                                                                style="width:<?php echo $omc_c2_width;?>%"></span></span>
                    <span class="omc-criteria-description"><?php echo $omc_c2_description; ?></span>
                </div><!-- /criteria -->
                <?php } ?>

            <?php if ($omc_c3_rating !== '') { ?>
                <div class="omc-review-criteria omc-criteria-star">
                    <span class="omc-criteria-star-under"><span class="omc-criteria-star-top"
                                                                style="width:<?php echo $omc_c3_width;?>%"></span></span>
                    <span class="omc-criteria-description"><?php echo $omc_c3_description; ?></span>
                </div><!-- /criteria -->
                <?php } ?>

            <?php if ($omc_c4_rating !== '') { ?>
                <div class="omc-review-criteria omc-criteria-star">
                    <span class="omc-criteria-star-under"><span class="omc-criteria-star-top"
                                                                style="width:<?php echo $omc_c4_width;?>%"></span></span>
                    <span class="omc-criteria-description"><?php echo $omc_c4_description; ?></span>
                </div><!-- /criteria -->
                <?php } ?>

            <?php if ($omc_c5_rating !== '') { ?>
                <div class="omc-review-criteria omc-criteria-star">
                    <span class="omc-criteria-star-under"><span class="omc-criteria-star-top"
                                                                style="width:<?php echo $omc_c5_width;?>%"></span></span>
                    <span class="omc-criteria-description"><?php echo $omc_c5_description; ?></span>
                </div><!-- /criteria -->
                <?php } ?>

            <?php if ($omc_c6_rating !== '') { ?>
                <div class="omc-review-criteria omc-criteria-star">
                    <span class="omc-criteria-star-under"><span class="omc-criteria-star-top"
                                                                style="width:<?php echo $omc_c6_width;?>%"></span></span>
                    <span class="omc-criteria-description"><?php echo $omc_c6_description; ?></span>
                </div><!-- /criteria -->
                <?php } ?>

            <?php } ?>



            <div class="omc-review-summary omc-final-score-<?php echo $omc_review_type ?>">

                <div id="omc-short-summary">
                    <p><strong>Summary:</strong> <?php echo $omc_longer_summary;?></p>
                </div>
                <!-- /omc-short-summary -->

                <div id="omc-criteria-final-score">
                    <span itemprop="rating"><h3><?php if ($omc_review_type == 'percent') {
                        echo ($omc_final_percentage . '<span>%</span>');
                    } else {
                        echo $omc_final_score;
                    } ?></h3></span>
                    <h4><?php echo $omc_brief_summary;?></h4>
                    <?php if ($omc_review_type == 'stars') { ?><span id="omc-final-score-stars-under"><span
                    id="omc-final-score-stars-top" style="width:<?php echo $omc_final_width;?>%"></span></span> <?php } ?>
                </div>
                <!-- /final-score -->

                <br class="clear"/>

            </div>
            <!-- /omc-review-summary -->

		<?php if($omc_user_ratings_visibility == 1) {?>		

            <div itemscope itemtype="http://data-vocabulary.org/Review-aggregate" class="omc-user-review-criteria">

                <span class="omc-user-review-description"><b><span class="your_rating"
                                                                   style="display:none;"><?php _e('Your Rating', 'gonzo'); ?></span><span
                    class="user_rating"><?php _e('User Rating', 'gonzo'); ?></span></b>: <span
                    class="score"><?php echo $ratings->current_rating; ?></span> <em>(<span
                    class="count"><?php echo $ratings->count; ?></span> <?php _e('votes', 'gonzo'); ?>)</em></span>
						
						<span class="omc-user-review-rating">
							<span class="omc-criteria-star-under"><span class="omc-criteria-star-top"
                                                                        style="width:<?php echo $ratings->current_position; ?>%"></span></span>
						</span>

            </div><!-- /omc-user-review-criteria -->
	
	<?php } ?>
	
        </div><!-- /omc-review-wrapper -->

            <?php } ?>

        <?php } ?>

    <?php if ($omc_criteria_display == 't') {
        the_content();
    } ?>


<div style="margin-top: 45pt; font-size: 7pt;" class="pagination">
<?php wp_link_pages(array(
    'before' => '<p>' . __(''),
    'after' => '</p>',
    'next_or_number' => 'next_and_number', # activate parameter overloading
    'nextpagelink' => __('下一頁'),
    'previouspagelink' => __('上一頁'),
    '<span>pagelink</span>' => '%',
    'echo' => 1 )
);
endwhile; endif; ?></div>







<?php if ( has_tag('麥片女孩') || (in_category('麥片女孩')) ) { ?>

<br class="clear"/>

<div class="rating" style="font-size: 12pt; text-align:center;">喜歡這位麥片女孩的介紹 <br/><br/>
<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
</div>

<br class="clear"/>

<style type="text/css">

/* #### bootstrap Form #### */
.bootstrap-frm {
    margin-left:auto;
    margin-right:auto;
    margin-bottom: 35px;
    max-width: 600px;
    background: #FFF;
    padding: 20px 30px 20px 30px;
    font: 12px "Helvetica Neue", Helvetica, Arial, sans-serif;
    color: #888;
    text-shadow: 1px 1px 1px #FFF;
    border:1px solid #DDD;
    border-radius: 5px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
}

.bootstrap-frm label {
    display: block;
    margin: 0px 0px 5px;
}
.bootstrap-frm label>span {
    float: left;
    width: 20%;
    text-align: right;
    padding-right: 10px;
    margin-top: 10px;
    color: #333;
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    font-weight: bold;
}
.bootstrap-frm input[type="text"], .bootstrap-frm input[type="email"], .bootstrap-frm textarea, .bootstrap-frm select{
    border: 1px solid #CCC;
    color: #888;
    height: 20px;
    line-height:15px;
    margin-bottom: 16px;
    margin-right: 6px;
    margin-top: 2px;
    outline: 0 none;
    padding: 5px 0px 5px 5px;
    width: 70%;
    border-radius: 4px;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;    
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
}
.bootstrap-frm select {
    appearance:none;
    -webkit-appearance:none; 
    -moz-appearance: none;
    text-indent: 0.01px;
    text-overflow: '';
    width: 100%;
    height: 35px;
    line-height:15px;
}
.bootstrap-frm textarea{
    height:100px;
    padding: 5px 0px 0px 5px;
    width: 100%;
}
.bootstrap-frm .button {
    background: #FFF;
    border: 1px solid #CCC;
    padding: 10px 25px 10px 25px;
    color: #333;
    border-radius: 4px;
}
.bootstrap-frm .button:hover {
    color: #333;
    background-color: #EBEBEB;
    border-color: #ADADAD;
}

input:invalid, textarea:invalid {
  background-color: #FCF8EA;
}

.get-mygirl-button {
  position: relative;
  vertical-align: top;
  width: 100%;
  height: 60px;
  padding: 0;
  margin-bottom: 20px;
  font-size: 22px;
  color: white;
  text-align: center;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);
  background: #e74c3c;
  border: 0;
  border-bottom: 2px solid #db4334;
  cursor: pointer;
  -webkit-box-shadow: inset 0 -2px #db4334;
  box-shadow: inset 0 -2px #db4334;
}


.get-mygirl-button:hover {
  background: #ff0000;
}

.get-mygirl-button:active {
  top: 1px;
  outline: none;
  -webkit-box-shadow: none;
  box-shadow: none;
}

</style>



<script>
(function( $ ) {
  $(function() {
  $("#show").click(function(){
    $("form").show();
    $("#show").hide();
    //add ga event for tracking
    __gaTracker('send', 'event', 'cereal-girl-form', 'open', '<?php the_permalink(); ?> ');
  });  });
})(jQuery);
</script>


<button class="get-mygirl-button" id="show">你也喜歡吃麥片？成為我們的麥片女孩！</button>

<form style="display: none;" class="bootstrap-frm" role="form" action="https://docs.google.com/forms/d/1GD9I_falMSbJNF_JhDWzvPGO23yYhXuImdj2TctCpV4/formResponse" method="POST" id="ss-form" target="_blank" onsubmit="">

<h3>你也可以麥片女孩！</h3>
<p>當麥片女孩就可以免費試吃最新麥片，<br/>還不快填下面資料！（*為必填欄位）</p>

<label>姓名/暱稱 * （格式為 陳家翔 / Chris）</label>
<input placeholder="" class="form-control" type="text" name="entry.1794029648" value="" class="ss-q-short" id="entry.1794029648" dir="auto" aria-label="姓名/暱稱" aria-required="true" required="" title="">
 <br/>

<label>Email * （請填寫正確，我們將會以此信箱與您聯絡）</label>
<input placeholder="" class="form-control" type="text" name="entry_680751096" value="" class="ss-q-short" id="entry_680751096" dir="auto" aria-label="Email  請輸入符合模式的內容" aria-required="true" required="" title=""><br/>

<label>電話 * （格式為 09xx-xxx-xxx）</label>
<input type="text" name="entry.506357596" value="" class="ss-q-short" id="entry_506357596" dir="auto" aria-label="電話 格式為 09xx-xxx-xxx " aria-required="true" required="" title=""><div class="error-message" id="378790941_errorMessage"></div><br/>

<label>地址 * （收到麥片的地址）</label>
<input type="text" name="entry.1171745469" value="" class="ss-q-short" id="entry_1171745469" dir="auto" aria-label="地址 收到麥片的地址 " aria-required="true" required="" title="">
<div class="error-message" id="1403136732_errorMessage"></div><br/>

<label>試吃的麥片 * （<a href="http://www.morningshop.tw/" target="_blank">在官網上</a>選擇妳想寫開箱文的產品網址，格式如下）</label>
<input type="text" name="entry.1340024935" value="http://www.morningshop.tw/item/201412AM090000360/A19639" class="ss-q-short" id="entry_1340024935" dir="auto" aria-label="想試吃的麥片 在官網選擇妳想寫開箱文的產品網址 ex. http://www.morningshop.tw/item/201412AM090000360/A19639 " aria-required="true" required="" title="">
<div class="error-message" id="276738255_errorMessage"></div><br/>

<label>臉書或 instagram 網址</label>
<input type="text" name="entry.1764760435" value="" class="ss-q-short" id="entry_1764760435" dir="auto" aria-label="臉書或 instagram 網址  " title="">
<div class="error-message" id="1693795329_errorMessage"></div><br/>



<label>授權範圍 *（<a href="https://docs.google.com/document/d/1HOj-KuP7AmJz25-q0vIPPtnPK4D0VmIuZPJK2plpnxY/edit?usp=sharing" rel="nofollow" target="_blank">本司將擁有文字及照片修改後使用其內容至該產品配合平台之權利</a>）</label>
<br/>
<input type="checkbox" name="entry.120718572" value="同意" id="group_120718572_1" role="checkbox" class="ss-q-checkbox" aria-required="true"> <span>同意 （需勾選才能參加）</span>
<div class="error-message" id="297045330_errorMessage"></div>
<br/>


<input type="hidden" name="draftResponse" value=""[,,&quot;-7966784405693144181&quot;]">
<input type="hidden" name="pageHistory" value="0">
<input type="hidden" name="fromEmail" value="false">
<input type="hidden" name="fbzx" value="-7966784405693144181">
<input class="button" type="submit" name="submit" value="&#25552;&#20132;" id="ss-submit">

<br/><br/>

送出資料後我們會盡快聯絡您哦！<br/>
請耐心等候～

</form>
<?php } ?>


<script>
    (function( $ ) {
      if ($(window).width() < 600) {

	document.write('<a rel=\"nofollow\" target=\"_blank\" href=\"http://line.me/R/msg/text/?<?php the_title(); ?>%0D%0A<?php the_permalink(); ?>?utm_source=line&utm_medium=usershare&utm_content=<?php the_title(); ?>\"><img src=\"http://i.imgur.com/OBK27by.png\" width=\"100%\" height=\"auto\" alt=\"用LINE傳送\" /></a><br/><a href=\"http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>\" target=\"_blank\"><img src=\"http://i.imgur.com/XBIrh7q.png\" width=\"100%\" height=\"auto\" alt=\"用FB傳送\" /></a><br/><br/><a href=\"http://line.me/ti/p/%40rul1812v\" target=\"_blank\" rel=\"nofollow\"><img height=\"36\" border=\"0\" alt=\"好友人數\" width=\"100%\" height=\"auto\"  src=\"http://biz.line.naver.jp/line_business/img/btn/addfriends_zh-Hant.png\"></a><br class=\"clear\"/><br/>');

     }
    })(jQuery);
</script>  


<a class="shop-btn backshoplink" href="http://www.morningshop.tw?utm_source=official-blog&utm_medium=article-bottom&utm_campaign=mainsite-link&utm_content=<?php the_title(); ?>" onclick="__gaTracker('send', 'event', 'mainsite-link', 'bottom', '<?php the_permalink(); ?> ');">回主站買麥片</a>


<p>喜歡，按讚給我們穀粒（嚼嚼）</p>

<!-- 將這個標記放在標頭中，或放在內文結尾標記前面。 -->
<script src="https://apis.google.com/js/platform.js" async defer>
  {lang: 'zh-TW'}
</script>

<div class="g-plusone" data-annotation="inline" href="<?php the_permalink(); ?>" data-width="300"></div>

<div style="margin-bottom: 10px;" class="fb-like" data-width="300" data-href="<?php echo $url; ?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>



<br/>


<br class="clear"/>

<!--<h3>拍麥片，抽好禮活動！</h3>
<a href="http://bit.ly/1CFfOgb" target="_blank"><img class="alignnone size-medium wp-image-748" src="http://i2.wp.com/blog.morningshop.tw/wp-content/uploads/2015/03/11065988_10203159687187843_1924029227_o.jpg?fit=620%2C620"/></a>-->

<div class="omc-authorbox">

    <h4><?php _e('作者', 'gonzo');?>》<?php the_author_posts_link(); ?></h4>

    <div class="omc-author-pic"><a
        href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_avatar(get_the_author_meta('user_email'), '80', ''); ?></a>
    </div>

    <p><?php the_author_meta('description'); ?><br/>加入我們粉絲頁《<a href="https://www.facebook.com/ihealth123" rel="nofollow" target="_blank">早餐吃麥片 健康又方便</a>》</p>

</div>

<br class="clear" />

<p class="omc-single-tags"><?php the_tags('<b>文章標籤：</b> ', ', ', '<br />'); ?></p>


<div class="omc-related-posts">

    <h4><?php _e('相關文章', 'gonzo'); ?></h4>

    <?php if (has_tag()) { ?>
    <?php
    //for use in the loop, list 3 post titles related to first tag on current post
    $backup = $post; // backup the current object
    $tags = wp_get_post_tags($post->ID);
    $tagIDs = array();

    if ($tags) {

        $tagcount = count($tags);
        for ($i = 0; $i < $tagcount; $i++) {
            $tagIDs[$i] = $tags[$i]->term_id;

        }

        $args = array('tag__in' => $tagIDs, 'post__not_in' => array($post->ID), 'showposts' => 4, 'ignore_sticky_posts' => 1);
        $my_query = new WP_Query($args);

        if ($my_query->have_posts()) {

            while ($my_query->have_posts()) : $my_query->the_post(); ?>

                <article class="omc-related-post omc-module-c omc-quarter-width-category">

                    <a href="<?php the_permalink();?>" title="<?php the_title();?>">

                        <?php if (has_post_thumbnail()) {

                        the_post_thumbnail('half-landscape', array('class' => 'omc-image-resize'));

                    } else {

                        echo('<img src="' . get_template_directory_uri() . '/images/no-image-half-landscape.png" class="omc-image-resize" alt="no image" />');

                    } ?>

                    </a>

                    <h5 class="omc-related-article"><a href="<?php the_permalink();?>"
                                                       title="<?php the_title();?>"><?php the_title();?></a><span> &rarr;</span>
                    </h5>

                </article><!-- /omc-related-post -->

                <?php endwhile; ?>

            <br class="clear"/>

            <?php } else { ?>

            <h2><?php _e('沒有相關文章！', 'gonzo'); ?></h2>

            <?php
        }
    }
    $post = $backup; // copy it back
    wp_reset_query(); // to use the original query again
    ?>
    <?php } else { ?>

    <?php //if no tags then pull out content from the category

    $cat = get_the_category();

    $category = $cat[0]->cat_ID;

    global $wp_query, $paged, $post;

    $nextargs = array('cat' => $category, 'posts_per_page' => 4, 'post__not_in' => array($post->ID),);

    $nextloop = new WP_Query($nextargs);

    while ($nextloop->have_posts()) : $nextloop->the_post();

        ?>

        <article class="omc-related-post omc-module-c omc-quarter-width-category">

            <a href="<?php the_permalink();?>" title="<?php the_title();?>">

                <?php if (has_post_thumbnail()) {

                the_post_thumbnail('half-landscape', array('class' => 'omc-image-resize'));

            } else {

                echo('<img src="' . get_template_directory_uri() . '/images/no-image-half-landscape.png" class="omc-image-resize" alt="no image" />');

            } ?>

            </a>

            <h5 class="omc-related-article"><a href="<?php the_permalink();?>"
                                               title="<?php the_title();?>"><?php the_title();?></a><span> &rarr;</span>
            </h5>

        </article><!-- /omc-related-post -->

        <?php endwhile;
    rewind_posts();
    wp_reset_query(); ?>

    <br class="clear"/>

    <?php } ?>

</div><!-- /omc-related-posts -->

<br class="clear"/>

<div class="fb-comments" data-href="<?php echo $url; ?>" data-num-posts="5" data-width="100%"></div>

<br/>




		
	</article><!-- /omc-full-article -->

</section><!-- /omc-main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>