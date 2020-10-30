<?
class Propositions_model extends CI_Model
{
    public function selectUserProp($user_id)
    {
        $this->db->select('*');
        $this->db->from('propositions');
        $this->db->where('propositions.user_id', $user_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function countProp($user_id)
    {
        $this->db->select('*');
        $this->db->from('propositions');
        $this->db->where('propositions.user_id', $user_id);
        $count = $this->db->count_all_results();
        return $count;
    }
}
