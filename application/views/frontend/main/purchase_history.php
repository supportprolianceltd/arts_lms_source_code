<?php
$this->db->where('user_id', $this->session->userdata('user_id'));
$purchase_historys = $this->db->get('payment',$per_page, $this->uri->segment(3))->result_array();

    foreach($purchase_historys as $purchase_history){
        $i++;
        $purchase_history_course_details = $this->crud_model->get_course_by_id($purchase_history['course_id'])->row_array();
        $purchase_history_course_details_img_url=$this->crud_model->get_course_thumbnail_url($purchase_history_course_details['id']);
        $purchase_history_course_details_url=site_url('home/course/' . rawurlencode(slugify($purchase_history_course_details['title'])) . '/' . $purchase_history_course_details['id']);
        $purchase_history_amount=currency($purchase_history['amount']);
        $purchase_history_date_added=date('d M Y', $purchase_history['date_added']);
        $purchase_history_invoice_url=site_url('home/invoice/'.$purchase_history['id']);
        $purchase_history_td.=<<<HTML
        <tr>
              <td>$i</td>
              <td><a href="$purchase_history_course_details_url" class="text-15px text-dark ps-3 text-wrap">
                        {$purchase_history_course_details['title']}
                    </a></td>
              <td>$purchase_history_date_added</td>
              <td>{$purchase_history['payment_type']}</td>
              <td><span>Paid</span></td>
              <td class='d-none'>
                <div class="Gloow-Btns">
                <a href="#" class="start-learning-btn"><i class="ti-download"></i>Download Receipt</a>
              </div>
              </td>
            </tr>
HTML;
    }
require_once(__DIR__.'/views/purchase_history.php');
?>