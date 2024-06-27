<?php

namespace App\Repository;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;

interface VideoRepositoryInterface {
   public function addVideo(Request $request);
   public function addShort(Request $request);
   public function addComment(Request $request);
   public function addTimeStampComment(Request $request);
   public function editComment(Request $request,$id);
   public function deleteComment($id);
   public function toggleVideoLike($id);
   public function toggleCommentLike($id);
   public function listVideos(Request $request);
   public function getUserVideos(Request $request,$id);
   public function videoDetail($id);
   public function addViewOnVideo(Request $request,$id);
   public function getMyViewsAnalytics(Request $request);
}