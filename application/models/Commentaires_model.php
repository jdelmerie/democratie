<?
class Commentaires_model extends CI_Model
{
    public function add($data)
    {
        $this->db->set('time', 'NOW()', false);
        $this->db->insert('commentaires', $data);
    }

    public function getAll($id)
    {
        $this->db->select('commentaires.id, user_id, users.pseudo, comment, time');
        $this->db->join('users', 'users.id = user_id');
        $this->db->where('commentaires.prop_id', $id);
        $query = $this->db->get("commentaires");
        return $query->result();
    }
}
