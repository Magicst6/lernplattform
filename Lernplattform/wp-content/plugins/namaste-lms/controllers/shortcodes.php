<?php
// various Namaste shortcodes
class NamasteLMSShortcodesController {
	// what's todo in a lesson or course
	static
	function todo( $atts ) {
		global $post, $user_ID;
		// accept ordered or unordered list as argument
		if ( !is_user_logged_in() ) return "";

		$post_type = empty( $atts[ 'post_type' ] ) ? $post->post_type : $atts[ 'post_type' ];
		if ( !in_array( $post_type, array( 'namaste_lesson', 'namaste_course', 'namaste_module' ) ) )$post_type = $post->post_type;
		$post_id = empty( $atts[ 'post_id' ] ) ? $post->ID : intval( $atts[ 'post_id' ] );

		if ( $post_type == 'namaste_lesson' ) {
			$todo = NamasteLMSLessonModel::todo( $post_id, $user_ID );

			$list_tag = empty( $atts[ 0 ] ) ? 'ol' : $atts[ 0 ];
			if ( $list_tag != 'ul' && $list_tag != 'ol' )$list_tag = 'ol';

			ob_start();
			if ( @file_exists( get_stylesheet_directory() . '/namaste/lesson-todo.php' ) ) require get_stylesheet_directory() . '/namaste/lesson-todo.php';
			else require( NAMASTE_PATH . "/views/lesson-todo.php" );
			if ( !empty( $todo[ 'todo_nothing' ] ) )_e( 'This lesson has been completed.', 'namaste' );
			$content = ob_get_contents();
			ob_end_clean();
			return $content;
		}

		if ( $post_type == 'namaste_module' ) {
			$_module = new NamasteLMSModuleModel();
			$list_tag = empty( $atts[ 0 ] ) ? 'ol' : $atts[ 0 ];
			if ( $list_tag != 'ul' && $list_tag != 'ol' )$list_tag = 'ol';

			$required_lessons = $_module->required_lessons( $post_id, $user_ID );
			$required_lessons = apply_filters( 'namaste-reorder-lessons', $required_lessons );
			$content = "";

			if ( !empty( $required_lessons ) ) {
				$content .= "<" . $list_tag . " class='namaste-list'>\n";
				foreach ( $required_lessons as $lesson ) {
					$content .= "<li" . ( $lesson->namaste_completed ? ' class="namaste-completed" ' : ' class="namaste-incomplete" ' ) . "><a href='" . get_permalink( $lesson->ID ) . "'>" . $lesson->post_title . "</a> - ";
					if ( $lesson->namaste_completed )$content .= __( 'Completed', 'namaste' );
					else $content .= __( 'Not completed', 'namaste' );

					$content .= "</li>\n";
				}
				$content .= "</" . $list_tag . ">";
			}

			return $content;
		}


		if ( $post_type == 'namaste_course' ) {
			$_course = new NamasteLMSCourseModel();

			$list_tag = empty( $atts[ 0 ] ) ? 'ul' : $atts[ 0 ];
			if ( $list_tag != 'ul' && $list_tag != 'ol' )$list_tag = 'ol';

			$required_lessons = $_course->required_lessons( $post_id, $user_ID );
			$required_lessons = apply_filters( 'namaste-reorder-lessons', $required_lessons );
			$content = "";

			if ( !empty( $required_lessons ) ) {
				$content .= "<" . $list_tag . " class='namaste-list'>\n";
				foreach ( $required_lessons as $lesson ) {
					$content .= "<li" . ( $lesson->namaste_completed ? ' class="namaste-completed" ' : ' class="namaste-incomplete" ' ) . "><a href='" . get_permalink( $lesson->ID ) . "'>" . $lesson->post_title . "</a> - ";
					if ( $lesson->namaste_completed )$content .= __( 'Completed', 'namaste' );
					else $content .= __( 'Not completed', 'namaste' );

					$content .= "</li>\n";
				}
				$content .= "</" . $list_tag . ">";
			}

			return $content;
		}
	} // end todo

	// display enroll button
	static
	function enroll( $atts ) {
		global $wpdb, $user_ID, $user_email, $post;

		if ( !is_user_logged_in() ) {
			return sprintf( __( 'You need to be <a href="%s">logged in</a> to enroll in this course', 'namaste' ), wp_login_url( get_permalink( $post->ID ) ) );
		}

		// passed course id?
		if ( !empty( $atts[ 'course_id' ] ) ) {
			$post = get_post( $atts[ 'course_id' ] );
		}

		$enrolled = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM " . NAMASTE_STUDENT_COURSES .
			" WHERE user_id = %d AND course_id = %d", $user_ID, $post->ID ) );

		if ( empty( $enrolled->id ) ) {
			$currency = get_option( 'namaste_currency' );
			$is_manager = current_user_can( 'namaste_manage' );
			$_course = new NamasteLMSCourseModel();

			// stripe integration goes right on this page
			$accept_stripe = get_option( 'namaste_accept_stripe' );
			$accept_paypal = get_option( 'namaste_accept_paypal' );
			$accept_other_payment_methods = get_option( 'namaste_accept_other_payment_methods' );
			$accept_moolamojo = get_option( 'namaste_accept_moolamojo' );
			if ( $accept_stripe )$stripe = NamasteStripe::load();
			else $stripe = '';

			if ( !empty( $_POST[ 'stripe_pay' ] ) ) {
				NamasteStripe::pay( $currency );
				namaste_redirect( get_permalink( $post->ID ) );
			}

			if ( !empty( $_POST[ 'enroll' ] ) ) {
				// in case we use several shortcodes on the page make sure only the right course action is executed
				if ( empty( $atts[ 'course_id' ] )or $atts[ 'course_id' ] == $_POST[ 'course_id' ] ) {
					$mesage = NamasteLMSCoursesController::enroll( $is_manager );
					namaste_redirect( get_permalink( $post->ID ) );
				}
			}

			$_course->currency = $currency;
			$_course->accept_other_payment_methods = $accept_other_payment_methods;
			$_course->accept_paypal = $accept_paypal;
			$_course->accept_stripe = $accept_stripe;
			$_course->accept_moolamojo = $accept_moolamojo;
			$_course->stripe = $stripe;
			wp_enqueue_script( 'thickbox', null, array( 'jquery' ) );
			wp_enqueue_style( 'thickbox.css', '/' . WPINC . '/js/thickbox/thickbox.css', null, '1.0' );
			$post->post_id = $post->ID;
			$post->fee = get_post_meta( $post->ID, 'namaste_fee', true );
			return $_course->enroll_buttons( $post, $is_manager, $atts );
		} else {
			$post->namaste_course_status_shown = true;

			switch ( $enrolled->status ) {
				case 'enrolled':
					return __( 'You are enrolled in this course.', 'namaste' );
					break;
				case 'pending':
					return __( 'Your enroll request is received. Waiting for manager approval.', 'namaste' );
					break;
				case 'completed':
					return __( 'You have completed this course.', 'namaste' );
					break;
				case 'rejected':
					return __( 'Your enrollment request is rejected.', 'namaste' );
					break;
			}
		}
	}

	// display user points
	static
	function points( $atts ) {
		global $user_ID;
		$user_id = $user_ID;
		if ( !empty( $atts[ 0 ] )and is_numeric( $atts[ 0 ] ) )$user_id = $atts[ 0 ];

		$points = get_user_meta( $user_id, 'namaste_points', true );
		if ( empty( $points ) )$points = 0;
		return $points;
	}

	// displays leaderboard by points
	static
	function leaderboard( $atts ) {
		global $wpdb;

		$num_users = @$atts[ 0 ];
		if ( !is_numeric( $num_users ) )$num_users = 10;

		$display = empty( $atts[ 1 ] ) ? 'usernames' : 'table';

		// select top users
		$users = $wpdb->get_results( $wpdb->prepare( "SELECT tU.*, tM.meta_value as namaste_points FROM {$wpdb->users} tU JOIN {$wpdb->usermeta} tM
			ON tU.ID = tM.user_id AND tM.meta_key = 'namaste_points'
			ORDER BY namaste_points DESC LIMIT %d", $num_users ) );

		$html = "";
		if ( $display == 'usernames' ) {
			$html .= "<ol class='namaste-leaderboard'>";
			foreach ( $users as $user )$html .= "<li>" . $user->user_nicename . "</li>";
			$html .= "</ol>";
		} else {
			$html .= "<table class='namaste-leaderboard'><tr><th>" . __( 'User', 'namaste' ) . "</th><th>" . __( 'Points', 'namaste' ) . "</th></tr>";
			foreach ( $users as $user )$html .= "<tr><td>" . $user->user_nicename . "</td><td>" . $user->namaste_points . "</td></tr>";
			$html .= "</table>";
		}

		return $html;
	}

	// same as course lessons but passes is_module as true
	static
	function module_lessons( $atts ) {
		$atts[ 'is_module' ] = true;
		return self::lessons( $atts );
	}

	// display lessons in this course 
	// in table, just <ul>, or in user-defined HTML

	static
	function has_role( $role, $user_id = null ) {
		echo '<script>alert(' . $lesson->ID . ');</script>';
		if ( is_numeric( $user_id ) )
			$user = get_userdata( $user_id );
		else
			$user = wp_get_current_user();


		if ( empty( $user ) )
			return false;

		if ( is_array( $role ) ) {
			foreach ( $role as $r ) {
				if ( in_array( $r, ( array )$user->roles ) )
					return true;
			}
		} else {
			if ( in_array( $role, ( array )$user->roles ) )
				return true;
		}
		return false;
	}

	static
	function lessons( $atts ) {
		global $post;

		$status = @$atts[ 0 ];
		$course_id = empty( $atts[ 1 ] ) ? $post->ID : $atts[ 1 ];

		// however if the current post is module and not a course, we actually want to show other modules in the same course
		// similar to this, we may want to show the modules from the same course that a lesson belongs to on a lesson page.
		if ( empty( $atts[ 1 ] )and( 'namaste_module' == @$post->post_type or 'namaste_lesson' == @$post->post_type )and empty( $atts[ 'is_module' ] ) ) {
			$course_id = get_post_meta( $post->ID, 'namaste_course', true );
		}
		// when we are on lesson page and looking for module lessons, course_id is actually the module_id
		if ( empty( $atts[ 1 ] )and 'namaste_lesson' == @$post->post_type and!empty( $atts[ 'is_module' ] ) ) {
			$course_id = get_post_meta( $post->ID, 'namaste_module', true );
		}

		$ob = empty( $atts[ 2 ] ) ? '' : "tP." . $atts[ 2 ];
		$dir = empty( $atts[ 3 ] ) ? 'ASC' : $atts[ 3 ];
		$list_tag = empty( $atts[ 4 ] ) ? 'ul' : $atts[ 4 ];
		$show_excerpts = @$atts[ 'show_excerpts' ] ? true : false;
		$is_module = empty( $atts[ 'is_module' ] ) ? false : true;

		// validate the user input
		if ( $list_tag != 'ul' && $list_tag != 'ol' ) {
			$list_tag = 'ul';
		}


		// are we in the course desc page or in a lesson of this course?
		$this_post = get_post( $course_id );
		//if($this_post->post_type == 'namaste_lesson' ) $course_id = get_post_meta($course_id, 'namaste_course', true);


		// echo '<script>alert('.$role.');</script>';
		if ( empty( $status )or!is_user_logged_in() ) {
			$_lesson = new NamasteLMSLessonModel();

			$lessons = $_lesson->select( $course_id, 'array', null, $ob, $dir, $is_module );

			$content = "<" . $list_tag . " class='namaste-list'>";
			foreach ( $lessons as $lesson ) {
				$isshown = 0;

				$savedroles = 0;

				$savedusers = 0;

				$savedroles = get_post_meta( $lesson->ID, 'U_S_C_roles', true );

				//get saved users
				$savedusers = get_post_meta( $lesson->ID, 'U_S_C_users', true );

				if ( !$savedusers && !$savedroles ) {

					$content .= "<li><a href='" . get_permalink( $lesson->ID ) . "'>" . stripslashes( $lesson->post_title ) . "</a>";
					if ( $show_excerpts and!empty( $lesson->post_excerpt ) )$content .= wpautop( $lesson->post_excerpt );
					$content .= "</li>";

					$isshown = 1;
				}

				if ( isset( $savedroles ) && !empty( $savedroles ) && $isshown <> 1 ) {


					foreach ( ( array )$savedroles as $role ) {

						$user = wp_get_current_user();

						//$user = get_userdata( $user_ID );

						if ( is_array( $role ) ) {

							foreach ( $role as $r ) {
								if ( in_array( strtolower( $r ), ( array )$user->roles ) ) {

									$content .= "<li><a href='" . get_permalink( $lesson->ID ) . "'>" . stripslashes( $lesson->post_title ) . "</a>";
									if ( $show_excerpts and!empty( $lesson->post_excerpt ) )$content .= wpautop( $lesson->post_excerpt );
									$content .= "</li>";
									$isshown = 1;
								}
							}
						} else {

							if ( in_array( strtolower( $role ), ( array )$user->roles ) ) {

								$content .= "<li><a href='" . get_permalink( $lesson->ID ) . "'>" . stripslashes( $lesson->post_title ) . "</a>";
								if ( $show_excerpts and!empty( $lesson->post_excerpt ) )$content .= wpautop( $lesson->post_excerpt );
								$content .= "</li>";
								$isshown = 1;
							}
						}



					}
				}


				if ( isset( $savedusers ) && !empty( $savedusers ) && $isshown <> 1 ) {
					$current_user = wp_get_current_user();
					if ( in_array( $current_user->ID, $savedusers ) ) {

						$content .= "<li><a href='" . get_permalink( $lesson->ID ) . "'>" . stripslashes( $lesson->post_title ) . "</a>";
						if ( $show_excerpts and!empty( $lesson->post_excerpt ) )$content .= wpautop( $lesson->post_excerpt );
						$content .= "</li>";
						$isshown = 1;

					} else {
						
					}
					
				}
			
			}
			$content .= "</" . $list_tag . ">";
			return $content;
		}

		



		// status column is requested so we'll have to call the model method		
		ob_start();
		$_GET[ 'course_id' ] = $course_id;
		$simplified = empty( $status ) ? 2 : 1; // simplified is always at least 1 when called as shortcode. But will be 2 if status column is not requested

		NamasteLMSLessonModel::student_lessons( $simplified, $ob, $dir, true, $show_excerpts, $is_module, $atts );
		$content = ob_get_contents();
		ob_end_clean();
		return $content;


	}

	// displays modules within a course
	static
	function modules( $atts ) {
		global $post;

		$status = @$atts[ 0 ];

		// assume we are on course page showing its modules, unless course ID is passed.		
		$course_id = empty( $atts[ 1 ] ) ? $post->ID : $atts[ 1 ];

		// however if the current post is module and not a course, we actually want to show other modules in the same course
		// similar to this, we may want to show the modules from the same course that a lesson belongs to on a lesson page.
		if ( empty( $atts[ 1 ] )and( 'namaste_module' == @$post->post_type or 'namaste_lesson' == @$post->post_type ) ) {
			$course_id = get_post_meta( $post->ID, 'namaste_course', true );
		}


		$ob = empty( $atts[ 2 ] ) ? '' : "tP." . $atts[ 2 ];
		$dir = empty( $atts[ 3 ] ) ? 'ASC' : $atts[ 3 ];
		$list_tag = empty( $atts[ 4 ] ) ? 'ul' : $atts[ 4 ];
		$show_excerpts = @$atts[ 'show_excerpts' ] ? true : false;

		// validate the user input
		if ( $list_tag != 'ul' && $list_tag != 'ol' ) {
			$list_tag = 'ul';
		}

		// for this version let's keep it simple. Modules will be listed without status column
		$_module = new NamasteLMSModuleModel();

		$modules = $_module->select( null, $course_id, $ob, $dir );

		$content = "<" . $list_tag . " class='namaste-list'>";
		foreach ( $modules as $module ) {
			$content .= "<li><a href='" . get_permalink( $module->ID ) . "'>" . stripslashes( $module->post_title ) . "</a>";
			if ( $show_excerpts and!empty( $module->post_excerpt ) )$content .= wpautop( $module->post_excerpt );
			$content .= "</li>";
		}
		$content .= "</" . $list_tag . ">";
		return $content;
	}

	// displays simplified version of "My Courses" page
	static
	function my_courses( $atts ) {
		if ( !is_user_logged_in() ) return __( 'This content is for logged in users.', 'namaste' );
		// call the simplified version
		ob_start();
		NamasteLMSCoursesController::my_courses( true, $atts );
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}

	// displays simplified version of "My Certificates" page
	static
	function my_certificates() {
		if ( !is_user_logged_in() ) return __( 'This content is for logged in users.', 'namaste' );
		// call the simplified version
		ob_start();
		NamasteLMSCertificatesController::my_certificates( true );
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}

	// selects the next lesson or module in the course if any
	static
	function next_lesson( $atts ) {
		global $post, $wpdb;

		if ( empty( $post->ID )or( $post->post_type != 'namaste_lesson'
				and $post->post_type != 'namaste_module' ) ) return "";
		$next_text = ( $post->post_type == 'namaste_lesson' ) ? __( 'next lesson', 'namaste' ) : __( 'next module', 'mamaste' );
		$text = empty( $atts[ 0 ] ) ? $next_text : $atts[ 0 ];
		$cls = empty( $atts[ 'class' ] ) ? '' : sanitize_text_field( $atts[ 'class' ] );

		// select next lesson
		$course_id = get_post_meta( $post->ID, 'namaste_course', true );

		$next_lesson = $wpdb->get_row( $wpdb->prepare( "SELECT tP.* FROM {$wpdb->posts} tP
			JOIN {$wpdb->postmeta} tM ON tM.post_id = tP.ID AND tM.meta_key = 'namaste_course'
			WHERE tP.post_type = %s AND tM.meta_value = %d AND tP.ID > %d
			AND tP.post_status = 'publish' ORDER BY tP.post_date, tP.ID", $post->post_type, $course_id, $post->ID ) );
		if ( empty( $next_lesson->ID ) ) return "";

		return "<a href='" . add_query_arg( 'nmst', time(), get_permalink( $next_lesson->ID ) ) . "' class='$cls'>$text</a>";
	}

	// selects the previous lesson or module in the course if any
	static
	function prev_lesson( $atts ) {
		global $post, $wpdb;
		if ( empty( $post->ID )or( $post->post_type != 'namaste_lesson'
				and $post->post_type != 'namaste_module' ) ) return "";
		$prev_text = ( $post->post_type == 'namaste_lesson' ) ? __( 'previous lesson', 'namaste' ) : __( 'previous module', 'mamaste' );
		$text = empty( $atts[ 0 ] ) ? $prev_text : $atts[ 0 ];
		$cls = empty( $atts[ 'class' ] ) ? '' : sanitize_text_field( $atts[ 'class' ] );

		// select prev lesson
		$course_id = get_post_meta( $post->ID, 'namaste_course', true );
		$prev_lesson = $wpdb->get_row( $wpdb->prepare( "SELECT tP.* FROM {$wpdb->posts} tP
			JOIN {$wpdb->postmeta} tM ON tM.post_id = tP.ID AND tM.meta_key = 'namaste_course'
			WHERE tP.post_type = %s AND tM.meta_value = %d AND tP.ID < %d
			AND tP.post_status = 'publish' ORDER BY tP.ID DESC", $post->post_type, $course_id, $post->ID ) );

		if ( empty( $prev_lesson->ID ) ) return "";

		return "<a href='" . get_permalink( $prev_lesson->ID ) . "' class='$cls'>$text</a>";
	}

	// selects the first lesson in the course 
	static
	function first_lesson( $atts ) {
		global $post, $wpdb;
		if ( empty( $post->ID )or $post->post_type != 'namaste_course' ) return "";
		$cls = empty( $atts[ 'class' ] ) ? '' : sanitize_text_field( $atts[ 'class' ] );

		// select first lesson		
		$first_lesson = $wpdb->get_row( $wpdb->prepare( "SELECT tP.* FROM {$wpdb->posts} tP
			JOIN {$wpdb->postmeta} tM ON tM.post_id = tP.ID AND tM.meta_key = 'namaste_course'
			WHERE tP.post_type = 'namaste_lesson' AND tM.meta_value = %d AND tP.post_status = 'publish'
			ORDER BY tP.ID LIMIT 1", $post->ID ) );

		$text = empty( $atts[ 0 ] ) ? $first_lesson->post_title : $atts[ 0 ];

		if ( empty( $first_lesson->ID ) ) return "";

		return "<a href='" . get_permalink( $first_lesson->ID ) . "' class='$cls'>$text</a>";
	}

	// display grade on a course
	static
	function grade( $atts ) {
		global $wpdb, $user_ID;

		$grade = '';
		$course_id = intval( @$atts[ 'course_id' ] );
		if ( empty( $atts[ 'userlogin' ] ) )$user_id = $user_ID;
		else {
			$user = get_user_by( 'login', $atts[ 'userlogin' ] );
			$user_id = $user->ID;
		}

		// select grade
		if ( !empty( $course_id ) ) {
			$grade = $wpdb->get_var( $wpdb->prepare( "SELECT grade FROM " . NAMASTE_STUDENT_COURSES . "
				WHERE course_id = %d AND user_id = %d", $course_id, $user_id ) );
		}

		// lesson selected?
		if ( !empty( $atts[ 'lesson_id' ] ) ) {
			$grade = $wpdb->get_var( $wpdb->prepare( "SELECT grade FROM " . NAMASTE_STUDENT_LESSONS . "
				WHERE lesson_id = %d AND student_id = %d", intval( $atts[ 'lesson_id' ] ), $user_id ) );
		}

		if ( $grade != '' ) return $grade;
		else return @$atts[ 'whenempty' ];
	}

	// mark lesson completed
	static
	function mark() {
		global $wpdb, $post, $user_ID;

		if ( !is_user_logged_in() ) return "";

		// is the lesson in progress?
		$in_progress = $wpdb->get_var( $wpdb->prepare( "SELECT id FROM " . NAMASTE_STUDENT_LESSONS . " 
			WHERE lesson_id=%d AND student_id=%d AND status!=1", $post->ID, $user_ID ) );
		if ( !$in_progress ) return '';

		// ready for completion?
		if ( NamasteLMSLessonModel::is_ready( $post->ID, $user_ID, false, true ) ) {
			// display button or mark as completed
			if ( !empty( $_POST[ 'mark' ] ) ) {
				NamasteLMSLessonModel::complete( $post->ID, $user_ID );
				return __( 'Lesson completed!', 'namaste' );
			} else {
				return '<form method="post" action="">
				<p class="namaste-mark-button"><input type="submit" name="mark" value="' . __( 'Mark as completed', 'namaste' ) . '"></p>
				</form>';
			}
		}
	} // end mark

	// lesson assignments
	static
	function assignments( $atts ) {
		global $user_ID, $post, $wpdb;

		if ( !empty( $atts[ 'lesson_id' ] ) )$_GET[ 'lesson_id' ] = intval( $atts[ 'lesson_id' ] );
		if ( empty( $_GET[ 'lesson_id' ] ) )$_GET[ 'lesson_id' ] = $post->ID;
		$lesson_id = intval( $_GET[ 'lesson_id' ] );

		// prepare arguments
		$_GET[ 'student_id' ] = $user_ID;
		ob_start();

		// can't access based on module restrictions?
		if ( get_option( 'namaste_use_modules' ) ) {
			// belongs to module?
			$module_id = get_post_meta( $lesson_id, 'namaste_module', true );
			$module = get_post( $module_id );
			$module_access = get_post_meta( $module_id, 'namaste_access', true );

			// any not completed?
			$not_completed_ids = null;
			if ( !empty( $module_access ) ) {
				foreach ( $module_access as $mid ) {
					$is_completed = $wpdb->get_var( $wpdb->prepare( "SELECT id FROM " . NAMASTE_STUDENT_MODULES . " WHERE
                  module_id=%d AND student_id=%d AND status='completed'", $mid, $user_ID ) );
					if ( !$is_completed ) {
						// check on the fly, maybe lessons are completed but there are no requirements
						if ( NamasteLMSModuleModel::is_ready( $mid, $user_ID ) ) {
							// insert relation here
							$wpdb->query( $wpdb->prepare( "INSERT INTO " . NAMASTE_STUDENT_MODULES . " SET
									module_id=%d, student_id=%d, status='completed', enrollment_date=%s, completion_date=%s",
								$mid, $user_ID, date( 'Y-m-d', current_time( 'timestamp' ) ), date( 'Y-m-d', current_time( 'timestamp' ) ) ) );

							$mid = 0; // unset $mid so it's not inserted as not completed
						}
						if ( $mid )$not_completed_ids[] = $mid;
					}
				}
			}

			if ( !empty( $not_completed_ids ) ) {
				$content = __( 'You cannot see these assignments because there are unsatisfied module access requirements.', 'namaste' );
				return $content;
			}
		} // end if using modules

		// returning the view solutions page		
		if ( !empty( $_GET[ 'view_solutions' ] ) ) {
			NamasteLMSHomeworkController::view( true );
			$content = ob_get_clean();
			return $content;
		}

		// returning submit solution page
		if ( !empty( $_GET[ 'submit_solution' ] ) ) {
			NamasteLMSHomeworkController::submit_solution( true );
			$content = ob_get_clean();
			return $content;
		}

		// comments on assignment from Namaste Connect
		if ( !empty( $_GET[ 'connect_comments' ] )and class_exists( 'NamasteConComments' ) ) {
			NamasteConComments::comments( true );
			$content = ob_get_clean();
			return $content;
		}

		// add notes page
		if ( !empty( $_GET[ 'add_note' ] ) ) {
			NamasteLMSNoteModel::add_note( true );
			$content = ob_get_clean();
			return $content;
		}

		// normally we return the homeworks
		NamasteLMSHomeworkModel::lesson_homeworks( true );
		$content = ob_get_clean();
		return $content;
	}

	// shows the certificates earned in a course, if any
	static
	function earned_certificates( $atts ) {
		global $post, $user_ID;
		if ( !is_user_logged_in() ) return '';

		$course_id = empty( $atts[ 'course_id' ] ) ? @$post->ID : intval( $atts[ 'course_id' ] );
		if ( empty( $course_id ) ) return '';

		$text = @$atts[ 'text' ];

		return NamasteLMSCertificatesController::my_course_certificates( $course_id, $user_ID, $text );
	}

	// link to the course that lesson belongs to
	static
	function course_link( $atts ) {
		global $post;
		$lesson_id = empty( $atts[ 'lesson_id' ] ) ? $post->ID : intval( $atts[ 'lesson_id' ] );
		$course_id = get_post_meta( $lesson_id, 'namaste_course', true );
		$course = get_post( $course_id );
		$text = empty( $atts[ 'text' ] ) ? stripslashes( $course->post_title ) : $atts[ 'text' ];

		return '<a href="' . get_permalink( $course_id ) . '">' . $text . '</a>';
	}

	// conditional shortcode that allows displaying the enclosed content only when certain condition is / is not met
	static
	function condition( $atts, $content = null ) {
		if ( isset( $atts[ 'is_enrolled' ] ) ) return NamasteLMSCoursesController::is_enrolled_shortcode( $atts, $content );
	}

	// create search form with courses and lessons
	static
	function search( $atts ) {
		ob_start();
		NamasteLMSSearchController::form();
		$content = ob_get_clean();
		return $content;
	}

	// outputs the total number of published courses available on the site
	static
	function num_courses() {
		global $wpdb;

		$num_courses = $wpdb->get_var( "SELECT COUNT(ID) FROM {$wpdb->posts}
			WHERE post_type = 'namaste_course' 
			AND (post_status='publish' OR post_status='private')" );

		return $num_courses;
	}

	// outptus the total number of students in the site or num. students in a given course
	static
	function num_students( $atts ) {
		global $wpdb;

		$course_id_sql = '';
		if ( !empty( $atts[ 'course_id' ] )and is_numeric( $atts[ 'course_id' ] ) ) {
			$course_id_sql = $wpdb->prepare( " AND tC.course_id = %d ", $atts[ 'course_id' ] );
		}

		$num_students = $wpdb->get_var( "SELECT COUNT(tC.id) FROM " . NAMASTE_STUDENT_COURSES . " tC
			JOIN {$wpdb->posts} tP ON tP.ID = tC.course_id AND tP.post_type = 'namaste_course'
			AND (tP.post_status='publish' OR tP.post_status='private')
			WHERE tC.status = 'enrolled' $course_id_sql" );

		return $num_students;
	} // end num_students

	// outputs the num lessons in a course
	static
	function num_lessons( $atts ) {
		global $wpdb;

		if ( empty( $atts[ 'course_id' ] )or!is_numeric( $atts[ 'course_id' ] ) ) return "";

		$num_lessons = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(tP.ID) as num_lessons
			FROM {$wpdb->posts} tP JOIN {$wpdb->postmeta} tM ON tM.post_id = tP.ID
			AND tM.meta_key='namaste_course' AND tM.meta_value=%d
			WHERE tP.post_status='publish' OR tP.post_status='private'", $atts[ 'course_id' ] ) );

		return $num_lessons;
	} // end num_lessons

	// outputs the number of assignments total, or in course / lesson
	static
	function num_assignments( $atts ) {
		global $wpdb;

		$course_id_sql = '';
		if ( !empty( $atts[ 'course_id' ] )and is_numeric( $atts[ 'course_id' ] ) ) {
			$course_id_sql = $wpdb->prepare( " AND course_id = %d ", $atts[ 'course_id' ] );
		}

		$lesson_id_sql = '';
		if ( !empty( $atts[ 'lesson_id' ] )and is_numeric( $atts[ 'lesson_id' ] ) ) {
			$lesson_id_sql = $wpdb->prepare( " AND lesson_id = %d ", $atts[ 'lesson_id' ] );
		}

		$num_homeworks = $wpdb->get_var( "SELECT COUNT(id) FROM " . NAMASTE_HOMEWORKS . " WHERE 1 $course_id_sql $lesson_id_sql" );

		return $num_homeworks;
	} // end num_assignments

	// displays data from user profile of the currently logged user
	static
	function userinfo( $atts ) {
		global $user_ID;

		$user_id = empty( $atts[ 'user_id' ] ) ? $user_ID : intval( $atts[ 'user_id' ] );

		$field = $atts[ 'field' ];

		$user = get_userdata( $user_id );

		if ( isset( $user->data->$field )and!empty( $user->data->$field ) ) return $user->data->$field;
		if ( isset( $user->data->$field )and empty( $user->data->$field ) ) return @$atts[ 'default' ];

		// not set? must be in meta then
		$metas = get_user_meta( $user_id );
		if ( count( $metas )and is_array( $metas ) ) {
			foreach ( $metas as $key => $meta ) {
				if ( $key == $field and!empty( $meta[ 0 ] ) ) return $meta[ 0 ];
				if ( $key == $field and empty( $meta[ 0 ] ) ) return @$atts[ 'default' ];
			}
		}

		// nothing found, return the default if any
		return @$atts[ 'default' ];
	}

	// view of the gradebook
	static
	function gradebook( $atts ) {
		$course_id = intval( $atts[ 'course_id' ] );
		$public = ( !empty( $atts[ 'public_view' ] )and $atts[ 'public_view' ] == 'false' ) ? false : true;
		ob_start();
		NamasteLMSGradebookController::view( $course_id, $public, $atts );
		$content = ob_get_clean();
		return $content;
	}

	// the shortcode generator
	static
	function generator() {
		global $wpdb;

		// select courses
		$_course = new NamasteLMSCourseModel();
		$courses = $_course->select();

		$use_modules = get_option( 'namaste_use_modules' );
		if ( $use_modules == 1 and!empty( $_POST[ 'course_id' ] ) ) {
			$_module = new NamasteLMSModuleModel();
			$modules = $_module->select( 0, $_POST[ 'course_id' ] );
		}

		include( NAMASTE_PATH . '/views/shortcode-generator.html.php' );
	}

	static
	function my_gradebook( $atts ) {
		ob_start();
		$course_id = empty( $atts[ 'course_id' ] ) ? 0 : intval( $atts[ 'course_id' ] );
		NamasteLMSGradebookController::my_gradebook( $course_id, true );
		$content = ob_get_clean();
		return $content;
	}

	// shows lesson status - not started, in progress or completed
	static
	function lesson_status( $atts ) {
		global $post, $user_ID, $wpdb;
		$lesson_id = empty( $atts[ 'lesson_id' ] ) ? intval( @$post->ID ) : intval( $atts[ 'lesson_id' ] );

		if ( empty( $lesson_id )or empty( $user_ID ) ) return __( 'Not started', 'namaste' );

		// select student to lesson relation
		$student_lesson = $wpdb->get_row( $wpdb->prepare( "SELECT id, status FROM " . NAMASTE_STUDENT_LESSONS . " 
			WHERE student_id=%d AND lesson_id=%d", $user_ID, $lesson_id ) );

		if ( empty( $student_lesson->id ) ) return __( 'Not started', 'namaste' );
		if ( empty( $student_lesson->status ) ) return __( 'In progress', 'namaste' );
		return __( 'Completed', 'namaste' );
	}


}