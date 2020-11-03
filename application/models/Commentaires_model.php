<?
class Commentaires_model extends CI_Model
{
    public function add($data)
    {
        $this->db->set('time', 'NOW()', FALSE); 
        $this->db->insert('commentaires', $data);
    }

    public function selectAll($prop_id)
    {
        $this->db->select('commentaires.id, user_id, users.pseudo, comment, time');
        $this->db->from('commentaires');
        $this->db->join('users', 'users.id = user_id');
        $this->db->where('commentaires.prop_id', $prop_id);
        $query = $this->db->get();
        return $query->result();
    }
}