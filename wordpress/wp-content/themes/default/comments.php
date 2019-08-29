<?php
// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
  die ('Please do not load this page directly. Thanks!'); ?>

<div id="comments" class="forum-comments wow fadeInUp">
  <h3 class="text-blue-light text-super-small forum-comment-title"><?comments_number('0 Respostas', '1 Resposta', '% Respostas' )?></h3> <?php

  if ( have_comments() ) :
    $comments = get_comments(array(
      'post_id' => $post->ID,
      'status' => 'approve'
    )); ?>

		<ol class="commentlist"> <?php
			$args = [
				'avatar_size'		      => 64,
				'type'					      => 'comment',
				'format'				      => 'html5',
				'style'					      => 'div',
				'echo'					      => true,
        'callback'			      => 'commentario_personalizado',
        'reverse_top_level'   => true
			];
			wp_list_comments( $args, $comments); ?>
    </ol> <?php

    if ($wp_query->max_num_pages > 1) : ?>
      <div class="pagination">
        <ul>
          <li class="older"><?previous_comments_link('Anteriores')?></li>
          <li class="newer"><?next_comments_link('Novos')?></li>
        </ul>
      </div> <?php
    endif;
	endif;

	if ( comments_open() ) : ?>
	  <div id="respond" class="forum-respond">
			<h3 class="text-blue-light text-super-small forum-comment-title">Responder</h3>
			<form action="<?=get_option('siteurl')?>/wp-comments-post.php" method="post" id="commentform">
        <fieldset> <?php
          if ( $user_ID ) { ?>
            <p class="user-identification">Autenticado como <a href="javascript:console.log('link do perfil')"><?=$user_identity?></a>. <a href="<?=wp_logout_url()?>" title="Sair desta conta">Sair desta conta</a></p> <?php
          } else { ?>
            <div class="row">
              <div class="col-sm-6">
                <label class="text-blue-md-lighter text-md" for="author">Nome</label>
                <input type="text" name="author" id="author" value="<?=$comment_author?>" />
              </div>

              <div class="col-sm-6">
                <label class="text-blue-md-lighter text-md" for="email">Email</label>
                <input type="text" name="email" id="email" value="<?=$comment_author_email?>" />
              </div>
            </div><?php
          } ?>

          <div class="row">
            <div class="col-sm-12">
              <label class="text-blue-md-lighter text-md" for="comment">Comentário</label>
              <textarea name="comment" id="comment" rows="10"></textarea>
            </div>
            <div class="col-sm-12">
              <input type="submit" class="commentsubmit btn bg-blue-light text-white font-bold" value="Enviar" />
            </div>
          </div> <?php
          comment_id_fields();
          do_action('comment_form', $post->ID); ?>
        </fieldset>
      </form>
      <p class="cancel"><?cancel_comment_reply_link('Cancelar Resposta')?></p>
    </div> <?php
  else : ?>
    <h3 class="text-blue-light text-super-small">Respostas desativadas.</h3> <?php
  endif; ?>
</div>
