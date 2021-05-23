<?
class Votes_model extends CI_Model
{
    public function add($data)
    {
        $this->db->insert('votes', $data);
    }

    public function getUsersVote($id)
    {
        $this->db->where('user_id', $id);
        $query = $this->db->get('votes');
        return $query->result();
    }

    public function checkUserVote($prop_id, $user_id)
    {
        $this->db->where(['user_id' => $user_id, 'prop_id' => $prop_id]);
        $count = $this->db->count_all_results("votes");
        return $count;
    }
}
