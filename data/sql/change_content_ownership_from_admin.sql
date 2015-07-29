update op_opinable_content ooc, op_open_content oc, op_content c, op_user u set oc.user_id=6 where c.id=oc.content_id and oc.content_id=ooc.content_id and oc.user_id=1;
