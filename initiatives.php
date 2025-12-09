<?php include('header.php'); ?>
<!-- 
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
</div> -->

<div data-w-id="c50d35a4-afc5-52b4-4df2-051165d5d057" class="section-hero">
    <div class="container">
        <div class="hero-text-container">
            <div class="w-layout-grid hero-grid">
                <div id="w-node-c3f32631-6e7f-fd2b-83df-bd58ae7b1a25-cbdb8de7" class="content">
                    <div class="hero-black-text">
                        <div class="hero-text-content">
                            <h1 class="hero-text">My Initiatives</h1>
                        </div>
                    </div>
                    <div class="hero-white-text">
                        <img src="assets/img/sv.jpg"
                            alt="" class="hero-picture">
                        <div
                            class="hero-text-content">
                            <h1 class="hero-text white-text">My Initiatives</h1>
                        </div>
                    </div>
                </div>
                <div id="w-node-a7f4ec36-8b25-2bbb-bd92-46e5098299e7-cbdb8de7" class="content">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="section">
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
</div> -->

<div class="container mt-5">
    <ul class="nav nav-tabs justify-content-between d-flex w-75" id="myTab">
        <li class="nav-item">
            <a class="nav-link active" data-tab="home" href="#">
                <img src="assets/img/savanvorashow.svg" alt="Home" width="180" height="180">
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-tab="profile" href="#">
                <img src="assets/img/savanvorashow.svg" alt="Profile" width="180" height="180">
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-tab="contact" href="#">
                <img src="assets/img/pmj.svg" alt="Contact" width="180" height="180">
            </a>
        </li>
    </ul>


    <div class="tab-content mt-5" id="savanvorashow">
        <div class="tab-pane active" id="home">
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
        </div>
        <div class="tab-pane" id="profile">
            <div class="section">
                <div class="container">
                    <h5 data-w-id="bf21f31c-5b60-a9e6-c0f4-7018620aa09c">Mr. Savan Vora is not just a successful entrepreneur; he is a visionary leader with a deep sense of responsibility toward society. Beyond his business ventures, he has embarked on several impactful projects that reflect his commitment to creating value for others and inspiring positive change.</h5>
                    <h5 data-w-id="bf21f31c-5b60-a9e6-c0f4-7018620aa09c">One of his initiatives includes the launch of the podcast series Why Rajkot and Why Ahmedabad. These series serve as a platform to educate and empower individuals about the opportunities in the real estate markets of these cities. Featuring insightful conversations with some of the most prominent developers in Rajkot and Ahmedabad, as well as distinguished guests like former Chief Minister Mr. Vijaybhai Rupani, these podcasts explore the growth potential, investment benefits, and future prospects of these regions.</h5>
                    <h5 data-w-id="bf21f31c-5b60-a9e6-c0f4-7018620aa09c">Through these series, Savan not only highlights the economic opportunities in the real estate sector but also promotes the vision of these cities as hubs of progress and innovation. By bridging the gap between investors, developers, and the local communities, his podcasts have become a trusted source of information for anyone looking to explore real estate investments in Rajkot and Ahmedabad.</h5>
                    <h5 data-w-id="bf21f31c-5b60-a9e6-c0f4-7018620aa09c">With his ability for identifying opportunities and his dedication to spreading awareness, Mr. Savan Vora has successfully combined his entrepreneurial expertise with a passion for societal development, ensuring that his projects leave a lasting impact.</h5>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="contact">
            <div class="section">
                <div class="container">
                    <h5 data-w-id="bf21f31c-5b60-a9e6-c0f4-7018620aa09c">Savan Vora’s another belief is addressing societal norms and breaking stereotypes. One such initiative close to his heart is his talk show Papa Meri Jaan. This unique and heartfelt series is designed to challenge the age-old notion that fathers and sons cannot openly express their love and emotions for one another.</h5>
                    <h5 data-w-id="bf21f31c-5b60-a9e6-c0f4-7018620aa09c">In many cultures, the relationship between fathers and sons is often viewed as distant or bound by unspoken rules. Savan recognized this gap and sought to redefine the dynamic by fostering deeper emotional connections through his show. Papa Meri Jaan creates a safe, relatable, and inspiring space for fathers and sons to share their feelings, experiences, and vulnerabilities. The show shares honest and heartfelt conversations about the bond between fathers and sons, highlighting their challenges, successes, and the lessons they teach each other. By bringing these stories to the forefront, Savan aims to encourage families to embrace open communication and emotional expression.</h5>
                    <h5 data-w-id="bf21f31c-5b60-a9e6-c0f4-7018620aa09c">Through Papa Meri Jaan, Savan not only highlights the importance of nurturing relationships but also inspires viewers to break free from stereotypes and celebrate the unconditional love and respect between fathers and their children. His vision for the show is simple yet profound: to create a ripple effect that strengthens family bonds and encourages people to cherish their relationships openly and wholeheartedly.</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>