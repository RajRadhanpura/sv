<?php include('header.php'); ?>

<div class="section">
    <div class="horizontal-scroller hero">
        <div data-w-id="2797be1f-952f-d3cc-cf52-5041c8f40593" class="horizontal-scroll-track">
            <div class="horizontal-scroller-content">
                <div class="container">
                    <div class="scroller-track hero large">
                        <div class="anim-on-load-container">
                            <div style="opacity:1;display:block" class="animonload-right"></div>
                            <h1>Savan Vora's Initiatives</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-3">
                <img src="assets/img/savanvorashow.svg" alt="" class="initiatives-img">
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-3">
                <img src="assets/img/savanvorashow.svg" alt="" class="initiatives-img">
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-3">
                <img src="assets/img/savanvorashow.svg" alt="" class="initiatives-img">
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-3">
                <img src="assets/img/savanvorashow.svg" alt="" class="initiatives-img">
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <h5 data-w-id="bf21f31c-5b60-a9e6-c0f4-7018620aa09c">Currently, Savan Vora is creating a buzz with his ongoing podcast series, The Savan Vora Show. This platform is dedicated to exploring the journeys, challenges, and achievements of inspiring entrepreneurs from diverse fields. Through engaging and insightful conversations, Savan brings to light the stories behind their success, the lessons they've learned along the way, and the approaches they’ve taken to overcome obstacles.<br>‍</h5>
        <h5 data-w-id="bf21f31c-5b60-a9e6-c0f4-7018620aa09c">
            The podcast serves as a source of motivation and practical knowledge for aspiring entrepreneurs, professionals, and anyone seeking inspiration to pursue their goals. By diving deep into the experiences of these pioneers, Savan not only celebrates their accomplishments but also uncovers valuable insights into what it takes to thrive in a competitive world.<br>‍</h5>
        <h5 data-w-id="bf21f31c-5b60-a9e6-c0f4-7018620aa09c">
            With his signature conversational style, Savan creates an environment where guests can share their perspectives openly, making each episode a treasure trove of wisdom. The Savan Vora Show is more than just a podcast; it’s a movement to inspire, educate, and empower others to dream big and take meaningful action in their own lives. Through this series, Savan continues his mission of creating value and fostering growth, one conversation at a time.<br>‍</h5>
    </div>
</div>

<?php

$apiKey = 'AIzaSyAZpRY6NQYUzkz72smdT8zUZshSTcT8Ycg';
$channelId = 'UCebQxMXlg8v0WwRn-E8SvJA';

function fetchUploadsPlaylistId($channelId, $apiKey)
{
    $channelUrl = "https://www.googleapis.com/youtube/v3/channels?part=contentDetails&id={$channelId}&key={$apiKey}";
    $channelResponse = json_decode(file_get_contents($channelUrl), true);
    return $channelResponse['items'][0]['contentDetails']['relatedPlaylists']['uploads'] ?? null;
}

function fetchAllPlaylistVideos($playlistId, $apiKey)
{
    $allVideos = [];
    $nextPageToken = '';

    do {
        $playlistUrl = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId={$playlistId}&maxResults=50&key={$apiKey}&pageToken={$nextPageToken}&order=date";
        $response = json_decode(file_get_contents($playlistUrl), true);

        if (isset($response['items'])) {
            foreach ($response['items'] as $item) {
                $allVideos[] = $item;
            }
        }

        $nextPageToken = $response['nextPageToken'] ?? '';
    } while (!empty($nextPageToken));

    return $allVideos;
}

function fetchVideoDetails($videoIds, $apiKey)
{
    $videoIdChunks = array_chunk($videoIds, 50);
    $videoDetails = [];

    foreach ($videoIdChunks as $chunk) {
        $videoIdString = implode(',', $chunk);
        $videoUrl = "https://www.googleapis.com/youtube/v3/videos?part=contentDetails,snippet&id={$videoIdString}&key={$apiKey}";
        $response = json_decode(file_get_contents($videoUrl), true);

        if (isset($response['items'])) {
            foreach ($response['items'] as $item) {
                $videoDetails[] = $item;
            }
        }
    }

    return $videoDetails;
}

function convertYouTubeDurationToSeconds($youtubeDuration)
{
    $interval = new DateInterval($youtubeDuration);
    return ($interval->h * 3600) + ($interval->i * 60) + $interval->s;
}

$uploadsPlaylistId = fetchUploadsPlaylistId($channelId, $apiKey);
if (!$uploadsPlaylistId) {
    die("No uploads playlist found.");
}

$videos = fetchAllPlaylistVideos($uploadsPlaylistId, $apiKey);
$videoIds = array_map(function ($video) {
    return $video['snippet']['resourceId']['videoId'];
}, $videos);

if (empty($videoIds)) {
    die("No video IDs found in the playlist.");
}

$videoDetails = fetchVideoDetails($videoIds, $apiKey);
?>

<div class="section">
    <div class="container">
        <div class="row">
            <?php
            foreach ($videoDetails as $item) {
                $videoId = $item['id'];
                $title = $item['snippet']['title'];

                $thumbnail = $item['snippet']['thumbnails']['high']['url'] ?? '';
                $duration = $item['contentDetails']['duration'];
                $durationInSeconds = convertYouTubeDurationToSeconds($duration);

                if ($durationInSeconds > 120) {
                    $uniqueId = uniqid();

                    echo '<div class="col-lg-4 col-md-6 col-sm-12 col-12">';
                    echo '<a href="https://www.youtube.com/embed/' . $videoId . '" class="post-item w-inline-block" target="_blank">';
                    echo ' <div class="post-item-image-container">';
                    echo '<img id="thumbnail-' . $uniqueId . '" loading="lazy" src="' . $thumbnail . '" alt="' . $title . '" class="post-item-image">';
                    echo '</div>';
                    echo '<h6>' . $title . '</h6>';
                    echo '</a>';
                    echo '</div>';
                }
            }
            ?>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>