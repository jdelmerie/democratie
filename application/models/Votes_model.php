<?
class Votes_model extends CI_Model 
{
    public function setVote($data)
    {
        $this->db->insert('votes', $data);
    }

    public function voted()
    {
        $this->db->select('*');
        $this->db->from('votes');
        $query = $this->db->get();
        return $query->result();
    }

    public function checkvote($prop_id, $user_id)
    {
        $this->db->select('*');
        $this->db->from('votes');
        $this->db->where('user_id', $user_id);
        $this->db->where('prop_id', $prop_id);
        $count = $this->db->count_all_results();
        return $count;
    }
}