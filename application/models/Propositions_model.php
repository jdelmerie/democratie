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

    public function addProp($data)
    {
        $this->db->insert('propositions', $data);
    }

    public function selectById($id)
    {
        $this->db->select('*');
        $this->db->from('propositions');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result()[0];
    }

    public function updateProp($prop_id, $data)
    {
        $this->db->where('id', $prop_id);
        $this->db->set($data);
        $this->db->update('propositions');
    }

    public function soumission($prop_id, $data)
    {
        $this->db->where('id', $prop_id);
        $this->db->set($data);
        $this->db->update('propositions');
    }

    public function deleteProp($prop_id)
    {
        $this->db->where('id', $prop_id);
        $this->db->delete('propositions');
    }
    
}
